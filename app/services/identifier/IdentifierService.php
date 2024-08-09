<?php

namespace App\services\identifier;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IdentifierService
{
    public function __construct(protected User $model)
    {
    }

    public function login($data): JsonResponse
    {
        try {
            if (Auth::attempt($data->all())) {
                $user = Auth::user();
                $token = $user->createToken('buzzvelAPI')->accessToken;
                return response()->json([
                    'message' => 'User logged in successfully',
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'error' => 'Error in credentials'
                ], 401);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function register($data): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = $this->model::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password),
            ]);

            DB::commit();
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            if (Auth::guard('api')->check()){
                $accessToken = Auth::guard('api')->user()->token();
                DB::table('oauth_refresh_tokens')
                    ->where('access_token_id', $accessToken->id)
                    ->update(['revoked' => true]);
                $accessToken->revoke();
                return response()->json([
                    'message' => 'User logout successfully.'
                ]);
            } else {
                return response()->json([
                    'message' => 'Token not found'
                ],404);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error has occurred',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function profile(): JsonResponse {
        try {
            $user = Auth::guard('api')->user();
            return response()->json([
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error has occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
