@include('partials.header')

    <div class="content">
        <div class="card rounded-0 shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    List of Customer Complaints
                </h3>
            </div>
            <div class="card-body">
                {{-- <x-information /> --}}
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <table class="table table-bordered table-hover data-table">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Complaint</th>
                                    <th>Sentiment</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($complaints)
                                    @foreach ($complaints as $complaint)
                                        <tr>
                                            <td> {{$complaint['user']['lastname']}} {{$complaint['user']['firstname']}} {{$complaint['user']['middlename']}} </td>
                                            <td> {{ Str::limit($complaint['complaint_description'], 20) }} </td>
                                            <td> @php
                                                    if ($complaint['sentiments'] == 'positive') {
                                                        echo '<span class="badge badge-success">Positive</span>';
                                                    } else if ($complaint['sentiments'] == 'negative') {
                                                        echo '<span class="badge badge-danger">Negative</span>';
                                                    } else {
                                                        echo '<span class="badge badge-warning">Neutral</span>';
                                                    }
                                                @endphp </td>
                                            <td> {{ date('F d, Y', strtotime($complaint['created_at'])) }} </td>
                                            <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#complaintModal{{ $complaint['id'] }}">
                                                <i class="fas fa-eye"></i> View
                                            </button>

                                            <!-- Modal -->
                                            
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

    <div class="modal fade" id="complaintModal{{ $complaint['id'] }}" tabindex="-1" role="dialog" aria-labelledby="complaintModalLabel{{ $complaint['id'] }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="complaintModalLabel{{ $complaint['id'] }}">
                        Complaint Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Customer Information:</strong></h6>
                            <p><strong>Name:</strong> {{ ucwords($complaint['user']['lastname'] . ' ' . $complaint['user']['firstname'] . ' ' . $complaint['user']['middlename']) }}</p>
                            <p><strong>Email:</strong> {{ $complaint['user']['email'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Complaint Information:</strong></h6>
                            <p><strong>Date:</strong> {{ date('F d, Y', strtotime($complaint['created_at'])) }}</p>
                            <p><strong>Sentiment:</strong> 
                                @if ($complaint['sentiments'] == 'positive')
                                    <span class="badge badge-success">Positive</span>
                                @elseif ($complaint['sentiments'] == 'negative')
                                    <span class="badge badge-danger">Negative</span>
                                @else
                                    <span class="badge badge-warning">Neutral</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h6><strong>Complaint Description:</strong></h6>
                            <div class="border p-3 bg-light">
                                {{ $complaint['complaint_description'] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@include('partials.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>