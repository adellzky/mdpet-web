<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 401);
        }

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $customer = Customer::create($input);
        $success['name'] =  $customer->name;
        return response()->json([
            'success' => true,
            'message' => "Register Berhasil",
            "user" => $customer
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            throw ValidationException::withMessages([
                'email' => ['email incorrect']
            ]);
        }

        if (!Hash::check($request->password, $customer->password)) {
            throw ValidationException::withMessages([
                'password' => ['password incorrect']
            ]);
        }

        $token = $customer->createToken('api-token')->plainTextToken;
        return response()->json(
            [
                'token' => $token,
                'customer' => $customer->id_cust,
            ]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'logout successfully'
        ]);
    }
}
