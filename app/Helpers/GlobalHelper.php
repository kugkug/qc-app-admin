<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Http\Controllers\Api\ApplicationsController;
use App\Models\Application;
use App\Models\Applications;
use App\Models\Business;
use App\Models\Complaint;
use App\Models\History;
use App\Models\Payment;
use App\Models\PaymentLookUp;
use App\Models\BusinessRequirementLookUp;
use App\Models\BusinessTimelineLookUp;
use App\Models\RequirementLookUp;
use App\Models\TimelineLookUp;
use App\Models\ComplaintRequirementLookUp;
use App\Models\ComplaintTimelineLookUp;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class GlobalHelper {

    public function ajaxErrorResponse(string $message='', string $url=''): JsonResponse {
        Log::channel('info')->info($message);
        $messages = self::getMessages();
        $msg = ( ! empty($message) ) ? $message : $messages['default'];
        $js = ['js' => "_confirm('alert', '".$msg."');"];
        return response()->json($js, 200);
    }

    public function ajaxSuccessResponse(string $scripts): JsonResponse {
        $scripts = preg_replace('/\r\n+/S', "", $scripts);
        return response()->json(['js' => $scripts], 200);
    }
    
    private static function getMessages() {
        return config('system.messages');
    }

    public function generateApplicationRefNo() {
        return date("Y").substr(str_shuffle('1234567890'), 0, 6);
    }

    public function generatePaymentRefNo() {
        return 'O'.date("y").substr(str_shuffle('1234567890'), 0, 7).'R';
    }

    public function getTimeLines(): array {
        try {
            return TimelineLookUp::orderBy('order', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getRequirementTypes(): array {
        try {
            return RequirementLookUp::orderBy('id', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getBusinessRequirementTypes(): array {
        try {
            return BusinessRequirementLookUp::orderBy('id', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    

    public function updateApplicationStatusViaRefNo(string $ref_no, int $status): void {
        try {
            Application::where('application_ref_no', $ref_no)->update(['application_status' => $status]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }

    public function updateBusinessStatusViaRefNo(string $ref_no, int $status): void {
        try {
            Business::where('application_ref_no', $ref_no)->update(['application_status' => $status]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }

    public function getApplicationIdViaRefNo(string $ref_no): int {
        try {
            
            return Application::where('application_ref_no', $ref_no)->pluck('id')[0];
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }

    public function getApplicationsAll() {
        try {
            $applications = Application::orderBy('created_at', 'desc')
            ->with('user')
            ->with('classification')
            ->with('application_type')
            ->with('industry')
            ->with('sub_industry')
            ->with('business_line')
            ->get();

            if ($applications) {
                return [
                    'status' => true,
                    'applications' => $applications->toArray(),
                ];
            }
            
            return [
                'status' => false,
                'applications' => [],
            ];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'applications' => [],
            ];
        }
    }

    public function getBusinessesAll() {
        try {
            $businesses = Business::orderBy('created_at', 'desc')
            ->with('user')
            ->with('application_type')
            ->with('industry')
            ->with('sub_industry')
            ->with('histories')
            ->with('requirements')
            ->get();

            if ($businesses) {
                return [
                    'status' => true,
                    'businesses' => $businesses->toArray(),
                ];
            }
            
            return [
                'status' => false,
                'businesses' => [],
            ];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'businesses' => [],
            ];
        }
    }

    public function getComplaintsAll() {
        try {
            $complaints = Complaint::orderBy('created_at', 'desc')
            ->with('histories')
            ->get()->toArray();

            if ($complaints) {
                return [
                    'status' => true,
                    'complaints' => $complaints,
                ];
            }
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'complaints' => [],
            ];
        }
    }

    public function getApplicationsViaStatus(string $status) {
        try {            
            $applications = Application::where('application_status', $status)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->with('classification')
            ->with('application_type')
            ->with('industry')
            ->with('sub_industry')
            ->with('business_line')
            ->get();

            if ($applications) {
                return [
                    'status' => true,
                    'applications' => $applications->toArray(),
                ];
            }

            return [];            
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'applications' => [],
            ];
        }
    }

    public function getBusinessesViaStatus(string $status) {
        try {            
            $businesses = Business::where('application_status', $status)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->with('application_type')
            ->with('industry')
            ->with('sub_industry')
            ->get();

            if ($businesses) {
                return [
                    'status' => true,
                    'businesses' => $businesses->toArray(),
                ];
            }

            return [];            
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'applications' => [],
            ];
        }
    }

    public function getComplaintsViaStatus(string $status) {
        try {
            $complaints = Complaint::where('status', $status)
            ->orderBy('created_at', 'desc')
            ->with('histories')
            ->get()->toArray();

            if ($complaints) {
                return [
                    'status' => true,
                    'complaints' => $complaints,
                ];
            }

            return [
                'status' => false,
                'complaints' => [],
            ];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'complaints' => [],
            ];
        }
    }   

    public function getApplicationViaRefNo(string $ref_no) {
        try {
            $application = Application::where('application_ref_no', $ref_no)
            ->with('user')
            ->with('classification')
            ->with('application_type')
            ->with('industry')
            ->with('sub_industry')
            ->with('business_line')
            ->with('requirements')
            ->with('payment')
            ->get();

            if ($application) {
                return $application->toArray()[0];
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getBusinessViaRefNo(string $ref_no) {
        try {
            $business = Business::where('application_ref_no', $ref_no)
            ->with('user')
            ->with('application_type')
            ->with('industry')
            ->with('sub_industry')
            ->with('requirements')
            ->with('payment')
            ->get();

            if ($business) {
                return $business->toArray()[0];
            }
            return [];
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getComplaintViaRefNo(string $ref_no) {
        try {
            $complaint = Complaint::where('complaint_ref_no', $ref_no)
            ->with('histories')
            ->get();

            if ($complaint) {
                return $complaint->toArray()[0];
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getApplicationsViaUserId(int $user_id) {
        try {
            $applications = Application::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->with('histories')
            ->get();

                            
            if ($applications) {
                $applications =  array_map(function($application) {
                    $ordered_histories = [];
                    if ($application['histories']) {
                        foreach($application['histories'] as $history) { 
                            $ordered_histories[$history['timeline_look_up_id']] = $history;
                        }        
                        $application['histories'] = $ordered_histories;
                    }
                    return $application;
                },$applications->toArray());
                
                return $applications;
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function logHistory(string $ref_no, string $timeline): void {
        try {
            History::create([
                'application_ref_no' => $ref_no,
                'timeline_look_up_id' => $this->getTimelineIdViaName($timeline),
            ]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }

    public function logComplaintHistory(string $complaint_ref_no, string $timeline): void {
        try {
            History::create([
                'application_ref_no' => $complaint_ref_no,
                'timeline_look_up_id' => $this->getComplaintTimelineIdViaName($timeline),
            ]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }

    public function getHistory(string $ref_no): array {
        try {
            $app_histories = [];
            $histories = History::where('application_ref_no', $ref_no)->get();
            
            if ($histories) {
                foreach($histories as $history) {
                    $app_histories[$history->timeline_look_up_id] = $history->toArray();
                }
            }
            
            return $app_histories;
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getTimelineIdViaName(string $timeline): int {
        try {
            return TimelineLookUp::where('timeline', $timeline)->pluck('id')[0];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }

    public function getBusinessTimelineIdViaName(string $timeline): int {
        try {
            return BusinessTimelineLookUp::where('timeline', $timeline)->pluck('id')[0];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }

    public function getComplaintTimelineIdViaName(string $timeline): int {
        try {
            return ComplaintTimelineLookUp::where('timeline', $timeline)->pluck('id')[0];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }

    public function getApplicationData(
        string $ref_no,
        string $timeline,
        string $path,
    ) {
        return [
            'xrefno' => $ref_no,
            'xname' => $timeline,
            'xpath' => $path,
        ];
    }

    public function getPaymentTypes(): array {
        try {
            return PaymentLookUp::orderBy('id', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getPaymentDetails(string $ref_no) {
        try {
            $total = 0;
            $payment_types = [];
            $payment_details = Payment::where('application_ref_no', $ref_no)->get()->toArray()[0];
            $payment_information = [];
       
            foreach($this->getPaymentTypes() as $payment_type) { $payment_types[$payment_type['id']] = $payment_type; }
            
            foreach(json_decode($payment_details['payment_information'], true) as $payment_detail) {
                $payment_information[] = [
                    'id' => $payment_detail['id'],
                    'description' => $payment_types[$payment_detail['id']]['description'],
                    'amount' => $payment_detail['amount'],
                ];

                $total += $payment_detail['amount'];
            }

            return [
                    'details' => $payment_information, 
                    'total' => $total, 
                    'ref_no' => $payment_details['reference_no'],
                    'receipt' => $payment_details['receipt_photo'],
            ];
            
        } catch (Exception $e) { 
            Log::channel('info')->info(json_encode($e->getMessage()));
            return []; 
        }
    }

    public function getBusinessPaymentDetails(string $ref_no) {
        try {
            $total = 0;
            $payment_types = [];
            $payment_details = Payment::where('application_ref_no', $ref_no)->get()->toArray()[0]; 
            $payment_information = [];

            return [
                    'information' => $payment_details['payment_information'], 
                    'ref_no' => $payment_details['reference_no'],
                    'receipt_no' => $payment_details['reference_no'],
                    'receipt' => $payment_details['receipt_photo'],
            ];

            // foreach($this->getPaymentTypes() as $payment_type) { $payment_types[$payment_type['id']] = $payment_type; }
            
            // foreach(json_decode($payment_details['payment_information'], true) as $payment_detail) {
            //     $payment_information[] = [
            //         'id' => $payment_detail['id'],
            //         'description' => $payment_types[$payment_detail['id']]['description'],
            //         'amount' => $payment_detail['amount'],
            //     ];

            //     $total += $payment_detail['amount'];
            // }

            // return [
            //         'details' => $payment_information, 
            //         'total' => $total, 
            //         'ref_no' => $payment_details['reference_no'],
            //         'receipt' => $payment_details['receipt_photo'],
            // ];
            
        } catch (Exception $e) { 
            Log::channel('info')->info(json_encode($e->getMessage()));
            return []; 
        }
    }

    public function getComplaints() {
        try {
            $complaints = Complaint::orderBy('created_at', 'desc')
            ->with('user')
            ->get()->toArray();

            if ($complaints) {
                return [
                    'status' => true,
                    'complaints' => $complaints,
                ];
            }

            return [
                'status' => false,
                'complaints' => [],
            ];
        } catch (Exception $e) { 
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'complaints' => [],
            ];
        }
    }

    public function getUsersAll() {
        try {
            $users = User::orderBy('created_at', 'desc')->get()->toArray();
            
            if ($users) {
                return [
                    'status' => true,
                    'users' => $users,
                ];
            }

            return [
                'status' => true,
                'users' => [],
            ];


        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }
}