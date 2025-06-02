<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use PhpParser\Node\Expr\CallLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Note extends Model
{
    use HasFactory;
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
