@include('partials.header')

    <div class="content">
        <div class="card rounded-0 shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    List of Sanitary Permit Applications
                </h3>
            </div>
            <div class="card-body">
                {{-- <x-information /> --}}
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <table class="table table-bordered table-hover data-table">
                            <thead>
                                <tr>
                                    <th>Reference No.</th>
                                    <th>Type</th>
                                    <th>Company Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($businesses)
                                {{-- @dd($businesses); --}}
                                    @foreach ($businesses as $business)
                                        <tr>
                                            <td> {{$business['application_ref_no']}} </td>
                                            <td> {{$business['application_type']['application']}} </td>
                                            <td> 
                                                {{ ucwords($business['company_name'] )}} 
                                            </td>
                                            
                                            <td> 
                                                @php
                                                    echo ($business['application_status']) ? 
                                                        config('system.application_progress_status')[$business['application_status']] :
                                                        "New";
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@include('partials.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>