<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassPost extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function grades()
    {
        return $this->hasMany(PostGrade::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
