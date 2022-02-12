<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;

class UserValidator extends Validator{

    public function validateSignupRequest($input)
    {
        $rule = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];
        return Validator::make($input, $rule);
    }

    public function validateLoginRequest($input)
    {
        $rule = [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ];
        return Validator::make($input, $rule);
    }
}
