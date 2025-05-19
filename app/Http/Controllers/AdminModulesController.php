<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminModulesController extends Controller {

    public $data;
    public function __construct() {}
    
    public function index() {
        return view("index")->with(['page_name' => "Log In"]);
    }

    public function dashboard() {
        return view("pages.dashboard")->with(['page_name' => "Dashboard"]);
    }

    public function applications() {
        $applications = globalHelper()->getApplicationsAll();
        
        $this->data['applications'] = $applications['applications'];
        $this->data['page_name'] = 'Applications';
        return view('pages.applications.index', $this->data);
    }
    
    public function for_review() {
        $applications = globalHelper()->getApplicationsViaStatus(config('system.application_status')['uploaded_requirements']);
        
        $this->data['applications'] = $applications['applications'];
        $this->data['page_name'] = 'Applications - For Review';
        return view('pages.applications.for-review', $this->data);
    }

    public function review_application($application_ref_no) {
        $application = globalHelper()->getApplicationViaRefNo($application_ref_no);
        
        $this->data['application'] = $application;
        $this->data['application_ref_no'] = $application_ref_no;
        $this->data['payment_types'] = globalHelper()->getPaymentTypes();
        $this->data['page_name'] = 'Applications - For Review';
        return view('pages.for_review.index', $this->data);
    }


    public function payment_created() {
        $applications = globalHelper()->getApplicationsViaStatus(config('system.application_status')['created_payment']);
        
        $this->data['applications'] = $applications['applications'];
        $this->data['page_name'] = 'Applications - Order of Payments';
        return view('pages.applications.payment-created', $this->data);
    }

    public function payment_validation() {
        $applications = globalHelper()->getApplicationsViaStatus(config('system.application_status')['validated_payment']);
        
        $this->data['applications'] = $applications['applications'];
        $this->data['page_name'] = 'Applications - Payment Validations';

        // return view('pages.payment_validation.index')->with(['page_name' => 'Payment Validation']);
        
        return view('pages.applications.payment-validation', $this->data);   
    }

    public function review_payment($application_ref_no) {
        
        $application = globalHelper()->getApplicationViaRefNo($application_ref_no);

        $this->data['application'] = $application;
        $this->data['payment_details'] = globalHelper()->getPaymentDetails($application_ref_no);
        $this->data['application_ref_no'] = $application_ref_no;
        $this->data['payment_types'] = globalHelper()->getPaymentTypes();
        $this->data['page_name'] = 'Applications - Payment Validation';
        
        return view('pages.payment_validation.index', $this->data);
    }
    
    


    
    
    public function rejected() {
        return view('pages.rejected.index')->with(['page_name' => 'Rejected']);
    }

    public function validated() {
        return view('pages.validated.index')->with(['page_name' => 'Validated']);
    }

    

    
    public function completed() {
        return view('pages.completed.index')->with(['page_name' => 'Completed']);
    }

    public function released() {
        return view('pages.released.index')->with(['page_name' => 'Released']);
    }

    public function generate_report() {
        return view('pages.generate_report.index')->with(['page_name' => 'Generate Report']);
    }
    
}