<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInFormRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('auth.signIn');
    }

    public function login(SignInFormRequest $request)
    {   
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ]; 

        $remember_me = $request->remember_me ?? false;

        if (Auth::guard('users')->attempt($credentials, $remember_me)) {
            $url = $request->session()->get('url.intended', url(route('user.products')));
            return response()->json(['url' => $url]);
        }

        if (Auth::guard('admins')->attempt($credentials, $remember_me)) {
            return response()->json(['success_message' => 'Admin']);
        }

        return response()->json(['error_message' => 'Your account is not existed in our records']);
    }
}