<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{

    protected $fillable = [
        'uuid', 'password', 'username', 'salt', 'md5', 'sha1', 'sha256', 'customer_id'
    ];

    public function test()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }


}
