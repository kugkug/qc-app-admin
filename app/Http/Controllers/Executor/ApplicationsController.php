<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApplicationsController extends Controller
{
    public function updateRequirement($req_id, Request $request) {
        
        try {
            $response = apiHelper()->execute($request, "/api/requirement/update/$req_id", 'POST'); 
            
            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }

            $html_response = "location.reload();";
            // if ((int) $request->Status === array_keys(config('system.requirement_status'), 'Completed')[0]) {

            // } else {
                // globalHelper()->updateApplicationStatusViaRefNo(
                //     $request->ref_no, 
                //     config('system.application_status')['uploaded_requirements']
                // );

            // }

            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function createPaymentOrder($ref_no, Request $request) {
        
        try {
            $response = apiHelper()->execute($request, "/api/payment/create-order/$ref_no", 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->updateApplicationStatusViaRefNo(
                $ref_no, 
                config('system.application_status')['created_payment']
            );
            
            $html_response = "$('#modal-payment-order').modal('hide'); _systemAlert('info', 'Payment Order Created!')";
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function updatePaymentOrder($ref_no, Request $request) {
        
        try {

            $status = $request->Status;
            $response = apiHelper()->execute($request, "/api/payment/update/$ref_no", 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            if ($status == config('system.payment_status')['rejected']) {
                globalHelper()->updateApplicationStatusViaRefNo(
                    $ref_no, 
                    config('system.application_status')['created_payment']
                );
                $html_response = "
                    $('#modal-notes').modal('hide'); 
                    $('#modal-notes-payment').modal('hide');
                    _systemAlert('alert', 'Payment Rejected!')
                ";
            } else {
                globalHelper()->logHistory($ref_no, 'Payment Validation');
                globalHelper()->updateApplicationStatusViaRefNo(
                    $ref_no, 
                    config('system.application_status')['validated_payment']
                );
                $html_response = "$('#modal-payment-preview').modal('hide'); _systemAlert('info', 'Payment Validated!')";
            }            
            
            
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function approveApplication($ref_no, Request $request) {
        
        try {
            $response = apiHelper()->execute($request, "/api/applications/update/$ref_no", 'POST');
            
            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "_systemAlert('info', 'Application Approved!')";
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }
}