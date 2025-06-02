<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Client extends Model
{
    use HasFactory;


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(ClientStatus::class, 'client_status_id', 'id');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class, 'client_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'client_id', 'id');
    }
}
