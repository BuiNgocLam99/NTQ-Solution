<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInFormRequest;
use App\Services\UserService;

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
        $validatedData = $request->all();
        
        return $this->userService->login($validatedData);
    }
}
