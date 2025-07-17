@include('partials.header')

    <div class="content">
        <div class="card rounded-0 shadow-lg">
            <div class="card-header">
                <h3 class="card-title">
                    Card Title
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Health Certificates:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right datepicker" id="application_date" placeholder="Select Date Range">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" style="height: 100% !important;" data-trigger="generate_health_report">Generate Report</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2"></div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Sanitary Permits:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right datepicker" id="business_date" placeholder="Select Date Range">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" style="height: 100% !important;" data-trigger="generate_sanitary_report">Generate Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
@include('partials.footer')

<script>
    $(document).ready(function() {
        $('.datepicker').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
        });


        $('[data-trigger="generate_health_report"]').on('click', function() {
            let date = $('#application_date').val();
            $.ajax({
                url: '/generate_report/health_certificates',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    date: date
                },
                success: function(response) {
                    console.log(response);
                    eval(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('[data-trigger="generate_sanitary_report"]').on('click', function() {
            let date = $('#business_date').val();
            $.ajax({
                url: '/generate_report/sanitary_permits',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    date: date
                },
                success: function(response) {
                     console.log(response);
                    eval(response);
                    
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>