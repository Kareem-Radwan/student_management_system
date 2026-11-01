<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostGrade extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function post()
    {
        return $this->belongsTo(ClassPost::class, 'class_post_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
