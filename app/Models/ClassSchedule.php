<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    //optional
    public function label()
    {
        return $this->day . ' | ' . $this->start_time . ' - ' . $this->end_time;
    }
}
