<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class Application extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];

    
    public function classification(): HasOne {
        return $this->hasOne(ClassificationLookUp::class, 'id', 'classification_id');
    }

    public function application_type(): HasOne {
        return $this->hasOne(ApplicationTypeLookUp::class, 'id', 'application_type_id');
    }

    public function industry(): HasOne {
        return $this->hasOne(IndustryLookUp::class, 'id', 'industry_id');
    }

    public function sub_industry(): HasOne {
        return $this->hasOne(SubIndustryLookUp::class, 'id', 'sub_industry_id');
    }

    public function business_line(): HasOne {
        return $this->hasOne(BusinessLineLookUp::class, 'id', 'business_line_id');
    }

    public function histories(): HasMany {
        return $this->hasMany(History::class, 'application_ref_no', 'application_ref_no');
    }

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function requirements(): HasMany {
        return $this->hasMany(Requirements::class, 'application_ref_no', 'application_ref_no');
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class, 'application_ref_no', 'application_ref_no');
    }
}