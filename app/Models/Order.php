<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['client_id', 'order_status_id', 'title', 'description', 'amount' ]; //'finished_at'

    protected $casts = [
        'finished_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class, 'order_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'order_id', 'id');
    }

    //i've deleted hasmany...по ошибке но не могу понять что удалил
}
