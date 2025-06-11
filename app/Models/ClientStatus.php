<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientStatus extends Model
{
    public static function inRandomOrder()
    {
    }

    public function getColorClass(): string
    {
        return match($this->status) {
            'New' => 'bg-info bg-opacity-10',
            'Active' => 'bg-success bg-opacity-10',
            'Inactive' => 'bg-warning bg-opacity-10',
            'Banned' => 'bg-danger bg-opacity-10',
            default => 'bg-light',
        };
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'client_status_id', 'id');
    }
}
