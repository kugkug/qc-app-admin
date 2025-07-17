<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class ComplaintsController extends Controller
{
    public function recommendation_first(Request $request, $complaint_ref_no) {

        try {
            $response = apiHelper()->execute($request, "/api/complaints/recommendation-first/$complaint_ref_no", 'POST'); 
            
            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }

            $html_response = "location.reload();";
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }         
    }

    public function recommendation_second(Request $request, $complaint_ref_no) {
        try {
            $response = apiHelper()->execute($request, "/api/complaints/recommendation-second/$complaint_ref_no", 'POST'); 
        
            if ($response['status'] == false) {
                return isset($response['response']) ? 
                        globalHelper()->ajaxErrorResponse($response['response']) :
                        globalHelper()->ajaxErrorResponse('');
            }

            $html_response = "location.reload();";
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function recommendation_third(Request $request, $complaint_ref_no) {
        try {
            $response = apiHelper()->execute($request, "/api/complaints/recommendation-third/$complaint_ref_no", 'POST'); 
        
            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }

            $html_response = "location.reload();";
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function head_approval(Request $request, $complaint_ref_no) {
        try {
            $response = apiHelper()->execute($request, "/api/complaints/head-approval/$complaint_ref_no", 'POST'); 

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "location.reload();";
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }   
    
    public function resolved(Request $request, $complaint_ref_no) {
        try {
            $response = apiHelper()->execute($request, "/api/complaints/resolved/$complaint_ref_no", 'POST'); 

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "location.reload();";
            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }           
}   