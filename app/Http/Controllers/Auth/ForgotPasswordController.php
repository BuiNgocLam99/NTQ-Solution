<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordFormRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('auth.forgotPassword');
    }

    public function forgotPassword(ForgotPasswordFormRequest $request)
    {
        $result = $this->userService->forgotPassword($request->email);

        if ($result) {
            return response()->json(['success_message' => 'We have been sending password to your email!']);
        }
        return response()->json(['error_message' => 'Your email is not existed in our records!']);
    }
}
