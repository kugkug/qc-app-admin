@include('partials.header')

    <div class="content">
        <div class="card rounded-0 shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    Card Title
                </h3>
            </div>
            <div class="card-body">
                @include('components.information')
                
                <div class="row">
                    <div class="col-md-12">
                        @php
                    
                            $approve_key = config('system.payment_status')['approved'];
                            $app_url = config('system.app_client_url');
                            $requirements = [];
                            foreach ($application['requirements'] as $requirement) {
                                $requirements[$requirement['requirement']] = $requirement;
                            }

                        @endphp
                        {{-- <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" width="60%">Requirements</th>
                                    <th class="text-center" width="25%">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($global_requirement_types as $requirement_type)
                                @php
                                    $status_text = config('system.requirement_status')[$requirements[$requirement_type['id']]['status']];
                                    $status_class = config('system.requirement_status_class')[$status_text];
                                    $status = $requirements[$requirement_type['id']]['photo'] ? $status_text : 'No Upload'
                                @endphp
                                <tr>
                                    <td class="align-middle">{{ $requirement_type['title'] }}</td>
                                    <td class="text-center align-middle td-status {{ $status_class }}" id="td-status-{{$requirement_type['id']}}"> {{ $status }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-outline-info btn-flat btn-preview" 
                                            title="View Image"
                                            data-image="{{ $app_url }}requirements/{{ $requirements[$requirement_type['id']]['photo'] }}"
                                            data-id="{{ $requirement_type['id'] }}"
                                        >
                                            <i class="fas fa-image"></i> 
                                        </button>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table> --}}
                    </div>
                </div>
                @if($payment_details)
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="60%">Reference No.</th>
                                        <th class="text-center" width="25%">Total Amount</th>
                                        <th class="text-center">Receipt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class=" align-middle">
                                            {{ $payment_details['ref_no']}}
                                        </td>
                                        <td class="text-right  align-middle">
                                            {{ number_format($payment_details['total'], 2, ".", ",") }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-outline-info btn-flat btn-payment-preview" 
                                                title="View Image"
                                                data-image="{{ $app_url }}payments/{{ $payment_details['receipt']}}"                                            
                                            >
                                                <i class="fas fa-image"></i> 
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog"  id="modal-preview">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 60vh !important;"></div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog"  id="modal-payment-preview">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" >Items</th>
                                        <th class="text-center" >Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($payment_details && $payment_details['details'])
                                        @foreach ($payment_details['details'] as $detail)
                                            <tr>
                                                <td>{{ $detail['description']}}</td>
                                                <td class="text-right">{{ $detail['amount']}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>TOTAL</td>
                                            <td class="text-bold text-right">{{ number_format($payment_details['total'], 2, ".", ",") }}</td>
                                        </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="col-md-6  d-flex justify-content-center align-items-center div-receipt" >
                            
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button 
                        class="btn btn-outline-success btn-flat btn-approve" 
                        data-status="{{ $approve_key }}"
                        data-ref-no="{{ $application_ref_no }}"
                    >
                        Approve
                    </button>
                    {{-- <button class="btn btn-outline-danger btn-flat btn-require-update">
                        Requires Update
                    </button> --}}
                </div>
            </div>
        </div>
    </div>

@include('partials.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/health/payment-validation.js') }}"></script>