    
<div class="row">

    <div class="form-group col-lg-6">
        <dl>
            <dt class="font-weight-normal text-muted">Company Name</dt>
            <dd class="font-weight-bold border-bottom border-dark text-truncate">
                {{ ucwords(strtolower( $complaint['business_name'] )) }}
            </dd>
        </dl>

    </div>

    <div class="form-group col-lg-6">
        <dl>
            <dt class="font-weight-normal text-muted">Company Address</dt>
            <dd class="font-weight-bold border-bottom border-dark text-truncate">
                {{ ucwords(strtolower( $complaint['business_address'] )) }}
            </dd>
        </dl>
    </div>

    <div class="form-group col-lg-12">
        <dl>
            <dt class="font-weight-normal text-muted">Complaint Description</dt>
            <dd class="font-weight-bold border-bottom border-dark text-truncate">
                {{ ucwords(strtolower( $complaint['complaint_description'] )) }}
            </dd>
        </dl>
    </div>

    <div class="form-group col-lg-12 text-center">
        <dl>
            <dt class="font-weight-normal ">Complaint Photo</dt>
            <dd class="font-weight-bold ">
                <img src="{{ $app_url }}complaints/{{ $complaint['complaint_photo'] }}" style="width: 100%; height: auto;" alt="Complaint Photo" class="img-fluid">
            </dd>
        </dl>
    </div>

    @if ($complaint['recommendation_first'])
        <div class="form-group col-lg-12">
            <dl>
                <dt class="font-weight-normal text-muted">First Recommendation</dt>
                <dd class="font-weight-bold border-bottom border-dark text-truncate">
                    {{ ucwords(strtolower( $complaint['recommendation_first'] )) }}
                </dd>
            </dl>
        </div>
    @endif

    @if ($complaint['recommendation_second'])
        <div class="form-group col-lg-12">
            <dl>
                <dt class="font-weight-normal text-muted">Recommendation Second</dt>
                <dd class="font-weight-bold border-bottom border-dark text-truncate">
                    {{ ucwords(strtolower( $complaint['recommendation_second'] )) }}
                </dd>
            </dl>
        </div>
    @endif

    @if ($complaint['recommendation_third'])    
        <div class="form-group col-lg-12">
            <dl>
                <dt class="font-weight-normal text-muted">Recommendation Third</dt>
                <dd class="font-weight-bold border-bottom border-dark text-truncate">
                    {{ ucwords(strtolower( $complaint['recommendation_third'] )) }}
                </dd>
            </dl>
        </div>
    @endif
</div>
    