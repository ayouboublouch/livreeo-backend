<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends AbstractController
{
    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->successResponseWithData([
            'token' => $token,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        if (!$user = auth()->user()) {
            return $this->errorResponse(Response::HTTP_UNAUTHORIZED);
        }
        
        return $this->successResponseWithData([
            'user' => $user,
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        try {
            $refreshedToken = auth()->refresh();
        } catch (Exception) {
            return $this->errorResponse();
        }
        
        return $this->successResponseWithData([
            'token' => $refreshedToken,
        ]);
    }
}