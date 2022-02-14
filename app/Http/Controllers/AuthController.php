<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Validator\UserValidator;

class AuthController extends Controller
{
    private $userValidator;

    public function __construct()
    {
        $this->userValidator = new UserValidator();
    }
    public function signup(Request $request)
    {
        $validate = $this->userValidator->validateSignupRequest($request->all());
        if ($validate->fails()) {
            return response()->json([
                "status" => "fails",
                "message" => $validate->errors()->first(),
                "errors" => $validate->errors()->toArray(),
            ], 400);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function login(Request $request)
    {
        $validate = $this->userValidator->validateLoginRequest($request->all());
        if ($validate->fails()) {
            return response()->json([
                "status" => "fails",
                "message" => $validate->errors()->first(),
                "errors" => $validate->errors()->toArray(),
            ], 400);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'fails',
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'status' => 'success',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}
