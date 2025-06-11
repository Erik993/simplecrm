<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use PhpParser\Node\Expr\CallLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['client_id', 'order_id', 'content'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
