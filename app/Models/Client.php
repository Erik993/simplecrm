<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =['user_id', 'client_status_id', 'name', 'email',
        'company_name','phone', 'created_by'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
