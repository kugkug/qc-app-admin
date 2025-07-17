<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = 'complaints';

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function histories() {
        return $this->hasMany(History::class, 'application_ref_no', 'complaint_ref_no');
    }
}