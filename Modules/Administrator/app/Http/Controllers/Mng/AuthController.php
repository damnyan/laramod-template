<?php

namespace Modules\Administrator\Http\Controllers\Mng;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Modules\Administrator\Exceptions\InvalidCredentialsException;
use Modules\Administrator\Http\Requests\Mng\LoginRequest;
use Modules\Administrator\Http\Resources\Mng\AuthResource;
use Modules\Administrator\Models\Administrator;

/**
 * @tags Mng Auth
 */
class AuthController extends Controller
{
    /**
     * Login
     * @unauthenticated
     *
     * @param LoginRequest $request
     * @return AuthResource
     */
    public function login(LoginRequest $request): AuthResource
    {
        /** @var \Modules\Administrator\Models\Administrator $administrator */
        $administrator = Administrator::where(
            'email',
            $request->validated('email')
        )->first();

        if (
            is_null($administrator)
            || !Hash::check($request->password, $administrator->password))
        {
            throw new InvalidCredentialsException();
        }

        $token = $administrator->createToken(
            name: $administrator->email,
        );

        return new AuthResource(resource: $token);
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
