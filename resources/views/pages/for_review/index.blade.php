@include('partials.header')

    <div class="content">
        <div class="card rounded-0 shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-search"></i>
                    For Review
                </h3>
            </div>
            <div class="card-body">
                @include('components.information')
                <div class="row">
                    <div class="col-md-12">
                        @php
                    
                            $approve_key = array_keys(config('system.requirement_status'), 'Completed')[0];
                            $reject_key = array_keys(config('system.requirement_status'), 'Requires Update')[0];
                            $app_url = config('system.app_client_url');
                    
                            $requirements = [];
                            foreach ($application['requirements'] as $requirement) {
                                $requirements[$requirement['requirement']] = $requirement;
                            }

                        @endphp
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Requirements</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach ($global_requirement_types as $requirement_type)
                                @if ($requirements)
                                    @php
                                        $status_text = config('system.requirement_status')[$requirements[$requirement_type['id']]['status']];
                                        $status_class = config('system.requirement_status_class')[$status_text];
                                        $status = $requirements[$requirement_type['id']]['photo'] ? $status_text : 'No Upload'
                                    @endphp
                                    
                                    <tr>
                                        <td class="align-middle">{{ $requirement_type['title'] }}</td>
                                        <td class="text-center align-middle td-status {{ $status_class }}" id="td-status-{{$requirements[$requirement_type['id']]['id']}}"> 
                                            {{ $status }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-outline-info btn-flat btn-preview" 
                                                title="View Image"
                                                data-image="{{ $app_url }}requirements/{{ $requirements[$requirement_type['id']]['photo'] }}"
                                                data-id="{{ $requirements[$requirement_type['id']]['id'] }}"
                                            >
                                                <i class="fas fa-image"></i> 
                                            </button>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="align-middle">{{ $requirement_type['title'] }}</td>
                                        <td class="text-center align-middle td-status" > No Upload
                                        </td>
                                        <td class="text-center align-middle">
                                            -
                                        </td>
                                    </tr>
                                @endif

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-outline-danger btn-flat">Reject Application</button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end ">
                        {{-- <button class="btn btn-outline-danger btn-flat mr-2">Requires Update</button> --}}
                        <button class="btn btn-outline-primary btn-flat btn-payment-order" data-status="Completed" disabled="">Proceed Order of Payment</button>
                    </div>
                </div>
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
                <div class="modal-footer d-flex justify-content-between">
                    
                    <button 
                        class="btn btn-outline-success btn-flat btn-approve" 
                        data-status="{{ $approve_key }}"
                    >
                        Approve
                    </button>
                    <button class="btn btn-outline-danger btn-flat btn-require-update">
                        Requires Update
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog"  id="modal-notes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <textarea class="form-control rounded-0" cols="30" rows="10" data-key="Notes"></textarea>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button 
                        class="btn btn-outline-danger btn-flat btn-block btn-submit-note"
                        data-status="{{ $reject_key }}"
                        data-ref-no="{{ $application_ref_no }}"
                    >
                        Submit Note
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog"  id="modal-payment-order">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Types</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Requirements</th>
                                <th class="text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        @foreach ($payment_types as $key => $payment_type)
                            <tr>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input 
                                            class="form-check-input chk-pay-type" 
                                            type="checkbox"
                                            data-id="{{$payment_type['id']}}"
                                        >
                                        <label class="form-check-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>
                                    {{ $payment_type['description'] }}
                                </td>
                                <td>
                                    <input 
                                        type="number" 
                                        class="form-control text-right txt-amount"
                                        data-default="{{ $payment_type['default_amount'] }}"
                                        placeholder="0"
                                        disabled=""
                                        value="{{$payment_type['default_amount']}}"
                                    >
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="2" class="text-right align-middle">
                                    <strong>TOTAL:</strong>
                                </td>
                                <td>
                                    <input 
                                        type="text" 
                                        class="form-control text-right txt-total"
                                        placeholder="0"
                                        disabled=""
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button 
                        class="btn btn-outline-primary btn-flat btn-block btn-submit-payment-order"
                        data-ref-no="{{ $application_ref_no }}"
                    >
                        Create Order of Payment
                    </button>
                </div>
            </div>
        </div>
    </div>

@include('partials.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/health/upload-requirements.js') }}"></script>