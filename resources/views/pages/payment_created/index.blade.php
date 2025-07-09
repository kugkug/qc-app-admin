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

                        @if($payment_details)
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="60%">Reference No.</th>
                                            <th class="text-center" width="25%">Total Amount</th>
                                            {{-- <th class="text-center">Receipt</th> --}}
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
                                            {{-- <td class="text-center align-middle">
                                                <button class="btn btn-outline-info btn-flat btn-payment-preview" 
                                                    title="View Image"
                                                    data-image="{{ $app_url }}payments/{{ $payment_details['receipt']}}"                                            
                                                >
                                                    <i class="fas fa-image"></i> 
                                                </button>
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('partials.footer')