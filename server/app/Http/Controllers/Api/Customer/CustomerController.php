<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ChangePasswordRequest;
use App\Http\Requests\Customer\EditAccountRequest;
use Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        //Change Password
        $user = Auth::user();
        $user->password = $request->get('new_password');
        $user->save();

        return response()->json(
            [
                'data' => [
                    'message' => 'success',
                    ]
                ]
        );
    }

    public function editAccount(EditAccountRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->save();

        return response()->json(
            [
                'data' => [
                    'message' => "success",
                    ]
                ]
        );
    }
}