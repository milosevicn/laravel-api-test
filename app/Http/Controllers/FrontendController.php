<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\Http\Resources\User as ResourcesUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    private $loginAfterSignUp = true;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->locale = $request->locale;
        $user->save();
 
        if ($this->loginAfterSignUp) {
            return $this->authenticate($request);
        }
 
        return new ResourcesUser($user);
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'The specified account does not exist.',
            ], 401);
        }

        if (Hash::check($request->input('password'), $user->password)) {
            return new ResourcesUser($user);
        }

        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 401);
    }
}
