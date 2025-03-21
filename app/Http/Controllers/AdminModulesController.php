<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminModulesController extends Controller {

    public function index() {
        return view("index")->with(['page_name' => "Log In"]);
    }

    public function dashboard() {
        return view("pages.dashboard")->with(['page_name' => "Dashboard"]);
    }

    public function applications() {
        return view('pages.applications.index')->with(['page_name' => 'Applications']);
    }

    public function draft() {
        return view('pages.draft.index')->with(['page_name' => 'Draft']);
    }
    
    public function for_review() {
        return view('pages.for_review.index')->with(['page_name' => 'For Review']);
    }

    public function rejected() {
        return view('pages.rejected.index')->with(['page_name' => 'Rejected']);
    }

    public function validated() {
        return view('pages.validated.index')->with(['page_name' => 'Validated']);
    }

    public function payment_created() {
        return view('pages.payment_created.index')->with(['page_name' => 'Payment Created']);
    }

    public function payment_validation() {
        return view('pages.payment_validation.index')->with(['page_name' => 'Payment Validation']);
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