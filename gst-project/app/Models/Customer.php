<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'gstin', 'address', 'phone'];
    protected $hidden = ['password', 'remember_token'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
