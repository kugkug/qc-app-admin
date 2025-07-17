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
                    
                    <div class="col-md-6 d-flex">
                        {{-- <button class="btn btn-outline-danger btn-flat mr-2">Requires Update</button> --}}
                        <button class="btn btn-outline-success btn-flat btn-resolve-complaint" 
                            data-status="resolved" 
                            data-ref-no="{{ $complaint['complaint_ref_no'] }}"
                        >
                            Resolve Complaint
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    
@include('partials.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/complaints/process.js') }}"></script>