<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientStatus extends Model
{
    public static function inRandomOrder()
    {
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'client_status_id', 'id');
    }
}
