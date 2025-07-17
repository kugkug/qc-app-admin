@include('partials.header')

    <div class="content">
        <div class="card rounded-0 shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-search"></i>
                    Process Complaint
                </h3>
            </div>
            <div class="card-body">
                @php
                    $app_url = config('system.app_client_url');
                @endphp
                @include('components.complaint-information')
            </div>
            <div class="card-footer">
                <div class="row">
                    
                    <div class="col-md-12 d-flex justify-content-between">
                        {{-- <button class="btn btn-outline-danger btn-flat mr-2">Requires Update</button> --}}
                        <button class="btn btn-outline-primary btn-flat btn-add-recommendation" 
                            data-status="recommendation-first" 
                            data-ref-no="{{ $complaint['complaint_ref_no'] }}"
                        >
                            Add Recommendation
                        </button>

                        <button class="btn btn-outline-success btn-flat btn-apply-for-head-approval" 
                        data-status="head_approval" 
                        data-ref-no="{{ $complaint['complaint_ref_no'] }}"
                    >
                        Apply For Head Approval
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog"  id="modal-recommendation">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Recommendation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="recommendation">Recommendation</label>
                                <textarea class="form-control" rows="5" data-key="ThirdRecommendation" data="req"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button 
                        class="btn btn-outline-primary btn-flat btn-submit-recommendation-third" 
                        data-ref-no="{{ $complaint['complaint_ref_no'] }}" 
                        data-status="recommendation-third"
                    >
                        <i class="fas fa-check"></i> Submit
                    </button>

                   
                </div>
            </div>
        </div>
    </div>

   
    
@include('partials.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/complaints/process.js') }}"></script>