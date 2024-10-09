<?php

namespace Modules\Administrator\Http\Controllers\Mng\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Modules\Administrator\Http\Requests\Mng\My\UpdatePasswordRequest;

/**
 * @tags Mng My Password
 */
class PasswordController extends Controller
{
    /**
     * Update
     *
     * @param UpdatePasswordRequest $request
     * @return Response
     */
    public function update(UpdatePasswordRequest $request): Response
    {
        $user = $request->user();
        $user->password = $request->validated('password');
        $user->save();

        return response()->noContent();
    }
}
