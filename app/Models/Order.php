<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
    use HasFactory;
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function orderStatus()
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
}
