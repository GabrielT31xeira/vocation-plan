<?php

namespace App\Http\Controllers\api\identifier;

use App\Http\Controllers\Controller;
use App\Http\Requests\identifier\LoginRequest;
use App\Http\Requests\identifier\RegisterRequest;
use App\services\identifier\IdentifierService;
use Illuminate\Http\JsonResponse;

class IdentifierController extends Controller
{
    public function __construct(protected IdentifierService $identifierService)
    {
    }

    public function login(LoginRequest $request)
    {
        $response = $this->identifierService->login($request);
        return $response;
    }

    public function register(RegisterRequest $request)
    {
        $response = $this->identifierService->register($request);
        return response()->json($response);
    }

    public function logout()
    {
        $response = $this->identifierService->logout();
        return response()->json($response);
    }

    public function profile()
    {
        $response = $this->identifierService->profile();
        return response()->json($response);
    }
}
