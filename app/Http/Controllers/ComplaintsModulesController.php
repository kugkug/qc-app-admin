<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplaintsModulesController extends Controller
{
    public $data;
    public function __construct() {}
    
    public function all()
    {
        $complaints = globalHelper()->getComplaintsAll();

        $this->data['complaints'] = $complaints['complaints'];
        $this->data['page_name'] = 'Complaints - All';
        return view('pages.complaints.all', $this->data);
    }

    public function processing()
    {   
        $complaints = globalHelper()->getComplaintsViaStatus(config('system.complaint_status')['uploaded_requirements']); 

        $this->data['complaints'] = $complaints['complaints'];
        $this->data['page_name'] = 'Complaints - Processing';
        return view('pages.complaints.processing', $this->data);
    }

    public function recommendation_first()
    {
        $complaints = globalHelper()->getComplaintsViaStatus(config('system.complaint_status')['recommendation-first']);

        $this->data['complaints'] = $complaints['complaints'];
        $this->data['page_name'] = 'Complaints - FirstRecommendation';
        return view('pages.complaints.recommendation-first', $this->data);
    }

    public function recommendation_second() {
        $complaints = globalHelper()->getComplaintsViaStatus(config('system.complaint_status')['recommendation-second']);

        $this->data['complaints'] = $complaints['complaints'];
        $this->data['page_name'] = 'Complaints - Second Recommendation';
        return view('pages.complaints.recommendation-second', $this->data);
    }

    public function recommendation_third() {
        $complaints = globalHelper()->getComplaintsViaStatus(config('system.complaint_status')['recommendation-third']);

        $this->data['complaints'] = $complaints['complaints'];
        $this->data['page_name'] = 'Complaints - Third Recommendation';
        return view('pages.complaints.recommendation-third', $this->data);
    }

    public function head_approval() {
        $complaints = globalHelper()->getComplaintsViaStatus(config('system.complaint_status')['head_approval']);

        $this->data['complaints'] = $complaints['complaints'];
        $this->data['page_name'] = 'Complaints - Head Approval';
        return view('pages.complaints.head-approval', $this->data);
    }

    public function resolved() {
        $complaints = globalHelper()->getComplaintsViaStatus(config('system.complaint_status')['resolved']);

        $this->data['complaints'] = $complaints['complaints'];
        $this->data['page_name'] = 'Complaints - Resolved'; 
        return view('pages.complaints.resolved', $this->data);
    }


    // processing
    
    public function process_complaint($complaint_ref_no) {
        $complaint = globalHelper()->getComplaintViaRefNo($complaint_ref_no);
        
        $this->data['complaint'] = $complaint;
        $this->data['page_name'] = 'Complaints - Processing';
        return view('pages.complaints.process.processing', $this->data);
    }

    public function process_recommendation_first($complaint_ref_no) {
        $complaint = globalHelper()->getComplaintViaRefNo($complaint_ref_no);
        
        $this->data['complaint'] = $complaint;
        $this->data['page_name'] = 'Complaints - Recommendation First';
        return view('pages.complaints.process.recommendation-first', $this->data);
    }

    public function process_recommendation_second($complaint_ref_no) {
        $complaint = globalHelper()->getComplaintViaRefNo($complaint_ref_no);
        
        $this->data['complaint'] = $complaint;
        $this->data['page_name'] = 'Complaints - Recommendation Second';
        return view('pages.complaints.process.recommendation-second', $this->data);
    }

    public function process_recommendation_third($complaint_ref_no) {
        $complaint = globalHelper()->getComplaintViaRefNo($complaint_ref_no);
        
        $this->data['complaint'] = $complaint;
        $this->data['page_name'] = 'Complaints - Recommendation Third';
        return view('pages.complaints.process.recommendation-third', $this->data);
    }

    public function process_head_approval($complaint_ref_no) {
        $complaint = globalHelper()->getComplaintViaRefNo($complaint_ref_no);
        
        $this->data['complaint'] = $complaint;
        $this->data['page_name'] = 'Complaints - Head Approval';
        return view('pages.complaints.process.head-approval', $this->data);
    }

    public function process_resolved($complaint_ref_no) {
        $complaint = globalHelper()->getComplaintViaRefNo($complaint_ref_no);
        
        $this->data['complaint'] = $complaint;
        $this->data['page_name'] = 'Complaints - Resolved';
        return view('pages.complaints.process.resolved', $this->data);
    }

    public function process_completed($complaint_ref_no) {
        $complaint = globalHelper()->getComplaintViaRefNo($complaint_ref_no);
        
        $this->data['complaint'] = $complaint;
        $this->data['page_name'] = 'Complaints - Completed';
        return view('pages.complaints.process.completed', $this->data);
    }

}