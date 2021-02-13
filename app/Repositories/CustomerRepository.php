<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CustomerRepository
{

    public function insertCustomer($data)
    {
        collect($data->results)->each(
            function ($collection) {
                Customer::firstOrCreate([
                    'name' => Customer::getFullNameAttribute($collection->name->first, $collection->name->last),
                    'email' => $collection->email,
                    'gender' => $collection->gender,
                    'dob' => $collection->dob->date,
                    'age' => $collection->dob->age,
                    'street_name' => $collection->location->street->name,
                    'street_number' => $collection->location->street->number,
                    'city' => $collection->location->city,
                    'country' => $collection->location->country,
                    'postcode' => $collection->location->postcode,
                    'latitude' => $collection->location->coordinates->latitude,
                    'longitude' => $collection->location->coordinates->longitude,
                    'registered_date' => $collection->registered->date,
                    'registered_age' => $collection->registered->age,
                    'phone' => $collection->phone,
                    'cell' => $collection->cell
                ]);
            }
        );
        $this->insertLogin($data);
    }

    private function insertLogin($data) {
        collect($data->results)->each(
            function ($collection) {
                User::create([
                    'uuid' => $collection->login->uuid,
                    'password' => Hash::make($collection->login->password),
                    'username' => $collection->login->username,
                    'salt' => $collection->login->salt,
                    'md5' => $collection->login->md5,
                    'sha1' => $collection->login->sha1,
                    'sha256' => $collection->login->sha256,
                    'customer_id' => DB::getPdo()->lastInsertId()
                ]);
            }
        );
    }
}
