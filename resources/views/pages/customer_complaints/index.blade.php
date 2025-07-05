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
                                                <button type="button" class="btn btn-sm btn-primary" data-trigger="show-complaint-modal" data-complaint="{{ json_encode($complaint) }}">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
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

    <div class="modal fade" id="complaintModal" tabindex="-1" role="dialog" aria-labelledby="complaintModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="complaintModalLabel">
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
                            <p><strong>Name:</strong> <font class="text-uppercase customer-name">{{ ucwords($complaint['user']['lastname'] . ' ' . $complaint['user']['firstname'] . ' ' . $complaint['user']['middlename']) }}</font></p>
                            <p><strong>Email:</strong><font class="customer-email">{{ $complaint['user']['email'] }}</font></p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Complaint Information:</strong></h6>
                            <p><strong>Date:</strong> <font class="customer-date"></font></p>
                            <p><strong>Sentiment:</strong> 
                                <font class="customer-sentiment"></font>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h6><strong>Complaint Description:</strong></h6>
                            <div class="border p-3 bg-light">
                                <font class="customer-complaint-description"></font>
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

<script>
    $(document).ready(function() {
        $('[data-trigger="show-complaint-modal"]').on('click', function(event) {
            var button = $(this);
            var complaint = JSON.parse($(this).attr('data-complaint'));
            
            let sentiment = '';
            if (complaint['sentiments'] == 'positive') {
                sentiment = '<span class="badge badge-success">Positive</span>';
            } else if (complaint['sentiments'] == 'negative') {
                sentiment = '<span class="badge badge-danger">Negative</span>';
            } else {
                sentiment = '<span class="badge badge-warning">Neutral</span>';
            }
            console.log(sentiment);
            $('.customer-name').text(complaint['user']['lastname'] + ' ' + complaint['user']['firstname'] + ' ' + complaint['user']['middlename']);
            $('.customer-email').text(complaint['user']['email']);
            $('.customer-date').text(formatDate(complaint['created_at']));
            $('.customer-sentiment').html(sentiment);
            $('.customer-complaint-description').text(complaint['complaint_description']);

            $('#complaintModal').modal('show');
        });
    });

    function formatDate(created_at) {
        let date = new Date(created_at);
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
</script>