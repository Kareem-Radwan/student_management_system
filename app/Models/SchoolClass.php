<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    public const DEPARTMENTS = [
        'Programming',
        'Mathematics',
        'Networking',
        'Physics',
        'Biology',
        'PE',
        'Languages'
    ];

    public const DAYS = [
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student')->withTimestamps();
    }

    public function joinRequests()
    {
        return $this->hasMany(ClassJoinRequest::class);
    }

    public function materials()
    {
        return $this->hasMany(ClassMaterial::class)->latest();
    }

    public function posts()
    {
        return $this->hasMany(ClassPost::class)->latest();
    }
}
