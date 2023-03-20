<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpFormRequest;
use App\Services\UserService;

class SignUpController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('auth.signUp');
    }

    public function create(SignUpFormRequest $request)
    {
        $validatedData = $request->all();
        $result = $this->userService->create($validatedData);

        if($result){
            return response()->json(['success_message' => 'Registered successfully!']);
        }
    }
}
