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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($applications)
                                    @foreach ($applications as $application)
                                        <tr>
                                            <td class="align-middle"> {{$application['application_ref_no']}} </td>
                                            <td class="align-middle"> {{$application['application_type']['application']}} </td>
                                            <td class="align-middle">  
                                                {{ ucwords($application['user']['lastname']. " " .$application['user']['firstname'] . ", " .$application['user']['middlename'] )}} 
                                            </td>
                                            <td class="align-middle">
                                                {{ $application['classification']['classification'] }}
                                            </td>
                                            <td class="align-middle">
                                                <a href="/application/payment-created/{{$application['application_ref_no']}}" 
                                                    class="btn btn-outline-primary btn-flat"
                                                >
                                                    View
                                                </a>
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