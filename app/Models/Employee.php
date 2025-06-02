<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Employee extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'employee_id', 'id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'employee_id', 'id');
    }
}
