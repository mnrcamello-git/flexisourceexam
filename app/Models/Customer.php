<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{

    protected $fillable = [
        'name', 'email', 'country', 'gender', 'dob', 'age', 'street_name', 'street_number', 'city', 'country', 'postcode', 'latitude', 'longitude', 'registered_date', 'registered_age', 'phone', 'cell'
    ];

    static function getFullNameAttribute($first_name, $last_name)
    {
        return ucfirst($first_name) . ' ' . ucfirst($last_name);
    }

}
