<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
    "user_id",
    "department",
    "qualification",
    "join_date",
    "specialization"
    ] ;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
