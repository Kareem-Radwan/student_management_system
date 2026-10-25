<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_primary_contact' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'parent_student', 'parent_id', 'student_id')
            ->withPivot('is_primary')
            ->withTimestamps();
    }

    public function primaryStudents()
    {
        return $this->belongsToMany(Student::class, 'parent_student', 'parent_id', 'student_id')
            ->wherePivot('is_primary', true)
            ->withPivot('is_primary')
            ->withTimestamps();
    }

    public function getRelationship()
    {
        return ucfirst($this->relationship);
    }

    public function getName()
    {
        return $this->user->name;
    }
}
