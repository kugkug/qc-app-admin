<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\History;
use App\Models\Payment;
use App\Models\Requirements;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BusinessController extends Controller
{
    public function updateRequirements($requirement_id, Request $request) {
        DB::beginTransaction();
        try {
            
            $validated = validatorHelper()->validate('update_requirements', $request); 

            if (! $validated['status']) {
                return $validated;
            }

            Requirements::where('id', $requirement_id)->update($validated['validated']);
            

            DB::commit();

            return ['status' => true];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false, 'response' => $e->getMessage()];
            
        }

    }

    public function createPaymentOrder($ref_no, Request $request) {
        DB::beginTransaction();
        try {
            
            $business = globalHelper()->getBusinessViaRefNo($ref_no);
            
            $payment_data = [
                'payment_information' => "Please provide the payment information by uploading the receipt.",
                'application_ref_no' => $ref_no,
                'status' => config('system.payment_status')['for-review'],
                'checked_by' => Auth::id(),
            ];

            if ( Payment::where('application_ref_no', $ref_no)->get()->count() <= 0) {
                $payment_data['reference_no'] = globalHelper()->generatePaymentRefNo();
            } else {
                $payment_data['reference_no'] = Payment::where('application_ref_no', $ref_no)->first()->reference_no;
            }
            
            Payment::updateOrCreate(['application_ref_no' => $ref_no], $payment_data);
            
            globalHelper()->logHistory($ref_no, 'Requirements Validation');

            DB::commit();

            return ['status' => true];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    public function updatePaymentOrder($ref_no, Request $request) {
        DB::beginTransaction();
        try {
            
            $validated = validatorHelper()->validate('update_payment_order', $request);

            if (! $validated['status']) {
                return $validated;
            }
            
            Payment::updateOrCreate(['application_ref_no' => $ref_no], $validated['validated']);

            // $business = globalHelper()->getBusinessViaRefNo($ref_no);

            // globalHelper()->logHistory($ref_no, 'Payment Validation');
            
            DB::commit();

            return ['status' => true];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }    

    public function updateApplication(Request $request, $ref_no) {

        DB::beginTransaction();
        try {
            $status = $request->status;

            $updated = [];
            $validated = validatorHelper()->validate('business_update', $request);

            if (! $validated['status']) {
                return $validated;
            }
            
            $application = Business::where('application_ref_no', $ref_no)->first();
            
            if ($application) {
                $application->update($validated['validated']);
                $updated = $application->refresh();

                if(isset($validated['validated']['application_status'])) {
                    if ( $validated['validated']['application_status'] == config('system.application_status')['released']) {
                        History::create([
                            'application_ref_no' => $ref_no,
                            'timeline_look_up_id' => globalHelper()->getBusinessTimelineIdViaName('Head Approval'),
                        ]);
                    }
                    
                    History::create([
                        'application_ref_no' => $ref_no,
                        'timeline_look_up_id' => $validated['validated']['application_status'],
                    ]);
                }

                DB::commit();

                return [
                    'status' => true,
                    'response' => $updated,
                ];
            }
            
            Log::channel('info')->info("Invalid Reference No: " . $ref_no);
            return ['status' => false];
            
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }
}