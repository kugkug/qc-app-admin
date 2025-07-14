{{-- @dd($application) --}}
<div class="row">
    <div class="col-md-6">
        <dl class="row">
            <dt class="col-sm-4 text-muted">Company Name: </dt> <dd class="col-sm-8 font-weight-bold font-weight-bold">
                {{ 
                    ucwords(strtolower($business['company_name']))
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Date Applied: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    date('F d, Y', strtotime($business['created_at']))
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Application Type: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $business['application_type']['application']
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Industry: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $business['industry']['industry']
                }}
            </dd>
           
           
            {{-- <dt class="col-sm-4 text-muted">PESO Beneficiary Applicant: </dt> <dd class="col-sm-8 font-weight-bold">No</dd>
            <dt class="col-sm-4 text-muted">For in-house Laboratory: </dt> <dd class="col-sm-8 font-weight-bold">No</dd>
            <dt class="col-sm-4 text-muted">For pick-up: </dt> <dd class="col-sm-8 font-weight-bold">Yes</dd>
            <dt class="col-sm-4 text-muted">Pick-up Location: </dt> <dd class="col-sm-8 font-weight-bold">QC City Hall</dd> --}}
          </dl>
    </div>
    <div class="col-md-6">
        <dl class="row">
            <dt class="col-sm-4 text-muted">Email Address: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $business['user']['email']
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Contact Number: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $business['user']['contact']
                }}
            </dd>

            <dt class="col-sm-4 text-muted">Sub-industry: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $business['sub_industry']['sub_industry']
                }}
            </dd>
            
            
            
            
            
          </dl>
    </div>

</div>
