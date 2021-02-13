<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    private $users;

    public function index(request $request)
    {
        if ($request->customerId) {

            $user = User::where('customer_id', $request->customerId)->first();

            return [
                'full_name' => $user->customer->name,
                'email' => $user->customer->email,
                'username' => $user->username,
                'gender' => $user->customer->gender,
                'country' => $user->customer->country,
                'city' => $user->customer->city,
                'phone' => $user->customer->phone,
            ];
            
        } else {

            $user = User::all();

            $response = collect($user)->each(
                function ($collection) {
                    $this->users = [
                        'full_name' => $collection->customer->name,
                        'email' => $collection->customer->email,
                        'country' => $collection->customer->country,
                    ];
                }
            );

            $response[] = $this->users;

        }

        return response()->json($response);
    }
}
