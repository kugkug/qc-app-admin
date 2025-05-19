<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Payment;
use App\Models\Requirements;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApplicationsController extends Controller
{
    public function getAllApplications() {
        try {
            return globalHelper()->getApplicationsAll();
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'applications' => [],
            ];
        }
    }

    public function getApplicationViaStatus(Request $request) {
        try {
            $status = $request->status;
            
            return globalHelper()->getApplicationsViaStatus($status);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'applications' => [],
            ];
        }
    }

    public function updateApplication(Request $request, $ref_no) {

        DB::beginTransaction();
        try {
            $status = $request->status;

            $updated = [];
            $validated = validatorHelper()->validate('application_update', $request);

            if (! $validated['status']) {
                return $validated;
            }

            $application = Application::where('application_ref_no', $ref_no)->first();
            if ($application) {
                $application->update($validated['validated']);
                $updated = $application->refresh();

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
            
            return ['status' => false];
            
        }

    }

    public function createPaymentOrder($ref_no, Request $request) {
        DB::beginTransaction();
        try {
            
            $validated = validatorHelper()->validate('create_payment_order', $request);

            if (! $validated['status']) {
                return $validated;
            }

            $application = globalHelper()->getApplicationViaRefNo($ref_no);
            $validated['validated'] = array_merge($validated['validated'],
                    [
                        'status' => config('system.payment_status')['for-review'],
                        'checked_by' => Auth::id(),
                    ]
                );

            if ( Payment::where('application_ref_no', $ref_no)->get()->count() <= 0) {
                $validated['validated'] = array_merge($validated['validated'], ['reference_no' => globalHelper()->generatePaymentRefNo()]);
            }
            
            Payment::updateOrCreate(['application_ref_no' => $ref_no], $validated['validated']);
            
            globalHelper()->logHistory($application['id'], 'Requirements Validation');

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

            $application = globalHelper()->getApplicationViaRefNo($ref_no);
            globalHelper()->logHistory($application['id'], 'Payment Validation');
            
            DB::commit();

            return ['status' => true];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    
}