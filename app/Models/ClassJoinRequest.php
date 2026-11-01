<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassJoinRequest extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
