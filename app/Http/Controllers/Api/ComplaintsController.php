<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComplaintsController extends Controller
{
    public function recommendation_first(Request $request, $complaint_ref_no) {
        DB::beginTransaction();
        try {
            $validated = validatorHelper()->validate('update_complaint', $request); 

            if (! $validated['status']) {
                return $validated;
            }

            $status = $validated['validated']['status'];
            $validated['validated']['status'] = config('system.complaint_status')[$status];
            
            Complaint::where('complaint_ref_no', $complaint_ref_no)->update($validated['validated']);

            globalHelper()->logComplaintHistory(
                $complaint_ref_no,
                'Recommendation 1'
            );

            DB::commit();
            
            return ['status' => true];
            
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            DB::rollBack();
            
            return ['status' => false, 'response' => $e->getMessage()];
        }
    }

    public function recommendation_second(Request $request, $complaint_ref_no) {
        DB::beginTransaction();
        try {
            $validated = validatorHelper()->validate('update_complaint', $request); 

            if (! $validated['status']) {
                return $validated;
            }

            $status = $validated['validated']['status'];
            $validated['validated']['status'] = config('system.complaint_status')[$status];

            Complaint::where('complaint_ref_no', $complaint_ref_no)->update($validated['validated']);

            globalHelper()->logComplaintHistory(
                $complaint_ref_no,
                'Recommendation 2'
            );

            DB::commit();
            
            return ['status' => true];
            
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            DB::rollBack();
            
            return ['status' => false, 'response' => $e->getMessage()];
        }
    }

    public function recommendation_third(Request $request, $complaint_ref_no) {
        DB::beginTransaction();
        try {
            $validated = validatorHelper()->validate('update_complaint', $request); 

            if (! $validated['status']) {
                return $validated;
            }

            $status = $validated['validated']['status'];
            $validated['validated']['status'] = config('system.complaint_status')[$status];

            Complaint::where('complaint_ref_no', $complaint_ref_no)->update($validated['validated']);

            globalHelper()->logComplaintHistory(
                $complaint_ref_no,
                'Recommendation 3'
            );

            DB::commit();
            
            return ['status' => true];
            
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            DB::rollBack();
            
            return ['status' => false, 'response' => $e->getMessage()];
        }
        DB::commit();
            
        return ['status' => true];
        
    }

    public function head_approval(Request $request, $complaint_ref_no) {
        DB::beginTransaction();
        try {
            $validated = validatorHelper()->validate('update_complaint', $request); 

            if (! $validated['status']) {
                return $validated;
            }

            $status = $validated['validated']['status'];
            $validated['validated']['status'] = config('system.complaint_status')[$status];

            Complaint::where('complaint_ref_no', $complaint_ref_no)->update($validated['validated']);

            globalHelper()->logComplaintHistory(
                $complaint_ref_no,
                'Head Approval'
            );

            DB::commit();
            
            return ['status' => true];
            
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            DB::rollBack();
            
            return ['status' => false, 'response' => $e->getMessage()];
        }   
    }

    public function resolved(Request $request, $complaint_ref_no) {
        DB::beginTransaction();
        try {
            $validated = validatorHelper()->validate('update_complaint', $request); 

            if (! $validated['status']) {
                return $validated;
            }

            $status = $validated['validated']['status'];
            $validated['validated']['status'] = config('system.complaint_status')[$status];

            Complaint::where('complaint_ref_no', $complaint_ref_no)->update($validated['validated']);

            globalHelper()->logComplaintHistory(
                $complaint_ref_no,
                'Resolved'
            );

            DB::commit();
            
            return ['status' => true];
            
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            DB::rollBack();
            
            return ['status' => false, 'response' => $e->getMessage()];
        }
    }
}