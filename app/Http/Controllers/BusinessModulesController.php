<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessModulesController extends Controller
{
    public $data;
    public function __construct() {}
    
    public function applications() {
        $businesses = globalHelper()->getBusinessesAll();
        
        $this->data['businesses'] = $businesses['businesses'];
        $this->data['page_name'] = 'Businesses';
        return view('pages.businesses.index', $this->data);
    }
    
    public function for_review() {
        $businesses = globalHelper()->getBusinessesViaStatus(config('system.application_status')['uploaded_requirements']);
        
        $this->data['businesses'] = $businesses['businesses'];
        $this->data['page_name'] = 'Businesses - For Review';
        return view('pages.businesses.for-review', $this->data);
    }

    public function review_application($application_ref_no) {
        $business = globalHelper()->getBusinessViaRefNo($application_ref_no);
        
        $this->data['business'] = $business;  
        $this->data['application_ref_no'] = $application_ref_no;
        $this->data['payment_types'] = globalHelper()->getPaymentTypes();
        $this->data['page_name'] = 'Businesses - For Review';
        return view('pages.for_review.index_business', $this->data);
    }


    public function payment_created() {
        $applications = globalHelper()->getApplicationsViaStatus(config('system.application_status')['created_payment']);
        
        $this->data['applications'] = $applications['applications'];
        $this->data['page_name'] = 'Applications - Order of Payments';
        return view('pages.applications.payment-created', $this->data);
    }

    public function payment_validation() {
        $businesses = globalHelper()->getBusinessesViaStatus(config('system.application_status')['created_payment']);
        
        $this->data['businesses'] = $businesses['businesses'];
        $this->data['page_name'] = 'Businesses - Payment Validations';
        
        return view('pages.businesses.payment-validation', $this->data);   
    }

    public function view_payment_created($application_ref_no) {
        
        $business = globalHelper()->getBusinessViaRefNo($application_ref_no);

        $this->data['business'] = $business;
        $this->data['payment_details'] = globalHelper()->getPaymentDetails($business['application_ref_no']);
        $this->data['application_ref_no'] = $business['application_ref_no'];
        $this->data['payment_types'] = globalHelper()->getPaymentTypes();
        $this->data['page_name'] = 'Businesses - Order of Payments';
        
        return view('pages.businesses.payment-created', $this->data);
    }
    
    public function review_payment($application_ref_no) {
        
        $business = globalHelper()->getBusinessViaRefNo($application_ref_no);

        $this->data['business'] = $business;
        $this->data['payment_details'] = globalHelper()->getBusinessPaymentDetails($application_ref_no);
        
        $this->data['application_ref_no'] = $application_ref_no;
        $this->data['payment_types'] = globalHelper()->getPaymentTypes();
        $this->data['page_name'] = 'Businesses - Payment Validation';
        
        return view('pages.payment_validation.index_business', $this->data);
    }
    
    

    public function head_approval() {
        $businesses = globalHelper()->getBusinessesViaStatus(config('system.application_status')['water_analysis']);
        
        $this->data['businesses'] = $businesses['businesses'];
        $this->data['page_name'] = 'Businesses - Head Approval';

        // return view('pages.payment_validation.index')->with(['page_name' => 'Payment Validation']);
        
        return view('pages.businesses.head-approval', $this->data);   
    }

    public function review_approval($application_ref_no) {
        
        $business = globalHelper()->getBusinessViaRefNo($application_ref_no);

        $this->data['business'] = $business;
        $this->data['payment_details'] = globalHelper()->getBusinessPaymentDetails($application_ref_no);
        $this->data['application_ref_no'] = $application_ref_no;
        $this->data['payment_types'] = globalHelper()->getPaymentTypes();
        $this->data['page_name'] = 'Businesses - Head Approval';
        
        return view('pages.head_approval.index_business', $this->data);
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

    public function customer_complaints() {
        $complaints = globalHelper()->getComplaints();

        $this->data['complaints'] = $complaints['complaints'];
        $this->data['page_name'] = 'Customer Complaints';

        return view('pages.customer_complaints.index', $this->data);
    }
}