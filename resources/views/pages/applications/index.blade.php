@include('partials.header')

    <div class="content">
        <div class="card rounded-0 shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    List of Applications
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
                                    <th>Applicant</th>
                                    <th>Classification</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($applications)
                                    @foreach ($applications as $application)
                                        <tr>
                                            <td> {{$application['application_ref_no']}} </td>
                                            <td> {{$application['application_type']['application']}} </td>
                                            <td> 
                                                {{ ucwords($application['user']['lastname']. " ".$application['user']['firstname'] .", ".$application['user']['middlename'] )}} 
                                            </td>
                                            <td>
                                                @php
                                                    echo ($application['classification']['classification']) ? $application['classification']['classification'] : "-";
                                                @endphp
                                            </td>
                                            <td> 
                                                @php
                                                    echo ($application['application_status']) ? 
                                                        config('system.application_progress_status')[$application['application_status']] :
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