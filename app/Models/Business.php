<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    protected $table = 'businesses';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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


    public function histories(): HasMany {
        return $this->hasMany(History::class, 'application_id', 'id');
    }
    
    public function requirements(): HasMany {
        return $this->hasMany(Requirements::class, 'application_ref_no', 'application_ref_no');
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class, 'application_ref_no', 'application_ref_no');
    }
}