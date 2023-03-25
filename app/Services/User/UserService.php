<?php

namespace App\Services\User;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $attributes)
    {
        $slug = Str::slug($attributes['user_name']);

        $checkSlug = User::where('slug', $slug)->first();
        while ($checkSlug) {
            $slug = $checkSlug->slug . Str::rand(2);
        }

        $attributes['slug'] = $slug;
        $attributes['password'] = bcrypt($attributes['password']);

        return $this->userRepository->create($attributes);
    }

    public function forgotPassword($email)
    {
        $result =  $this->userRepository->findByEmail($email);
        if ($result) {
            $newPassword = Str::random(10);
            Mail::to($result->email)->send(new ForgotPasswordMail($newPassword));
            $data = ['password' => bcrypt($newPassword)];
            $this->userRepository->update($result->id, $data);
            return true;
        }
        return false;
    }
}
