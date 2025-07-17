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
            
        </div>
    </div>
   
    
@include('partials.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/complaints/process.js') }}"></script>