{{-- @dd($application) --}}
<div class="row">
    <div class="col-md-6">
        <dl class="row">
            <dt class="col-sm-4 text-muted">Full Name: </dt> <dd class="col-sm-8 font-weight-bold font-weight-bold">
                {{ 
                    ucwords(strtolower($application['user']['lastname']. ' ' .$application['user']['firstname']. ', ' .$application['user']['middlename']))
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Date Applied: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    date('F d, Y', strtotime($application['created_at']))
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Application Type: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $application['application_type']['application']
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Industry: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $application['industry']['industry']
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Email Address: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $application['user']['email']
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Date of Birth: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    date('F d, Y', strtotime($application['user']['birthdate']))
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
            
            <dt class="col-sm-4 text-muted">Sub-industry: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $application['sub_industry']['sub_industry']
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Gender: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    ucfirst(strtolower($application['user']['sex']))
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Contact Number: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $application['user']['contact']
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Nationality: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $application['user']['nationality'] ? ucfirst(strtolower($application['user']['nationality'])) : '-';
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Occupation: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    ucfirst(strtolower($application['user']['occupation']))
                }}
            </dd>
            <dt class="col-sm-4 text-muted">Company: </dt> <dd class="col-sm-8 font-weight-bold">
                {{
                    $application['company_name'] ? ucwords(strtolower($application['company_name'])) : '-';
                }}
            </dd>
          </dl>
    </div>

</div>
