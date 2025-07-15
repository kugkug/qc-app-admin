<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BusinessController extends Controller
{
    public function updateRequirement($req_id, Request $request) {
        
        try {
            $response = apiHelper()->execute($request, "/api/requirement/business-update/$req_id", 'POST'); 
            
            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }

            $html_response = "location.reload();";
            if ((int) $request->Status === array_keys(config('system.requirement_status'), 'Completed')[0]) {
                
            } else {
                globalHelper()->updateApplicationStatusViaRefNo(
                    $request->RefNo, 
                    config('system.application_status')['uploaded_requirements']
                );
            }

            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function createPaymentOrder($ref_no, Request $request) {
        try {
            $response = apiHelper()->execute($request, "/api/payment/business-create/$ref_no", 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->updateBusinessStatusViaRefNo(
                $ref_no, 
                config('system.application_status')['validated_requirements']
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
            $response = apiHelper()->execute($request, "/api/payment/business-update/$ref_no", 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->updateBusinessStatusViaRefNo(
                $ref_no, 
                config('system.application_status')['validated_payment']
            );
            
            $html_response = "$('#modal-payment-preview').modal('hide'); _systemAlert('info', 'Payment Validated!')";
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function approveApplication($ref_no, Request $request) {
        
        try {
            $response = apiHelper()->execute($request, "/api/businesses/update/$ref_no", 'POST');
            
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