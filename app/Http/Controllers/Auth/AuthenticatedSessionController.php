<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        try {
            $request->authenticate();
            $token = Auth::user()->createToken($request->token_name);
            return response(Auth::user());
        } catch (Exception $e) {
            var_dump(['status' => 'buggy', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
            return response(['status' => false, 'message' => 'Something went wrong', 'error' => $e], 500);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
