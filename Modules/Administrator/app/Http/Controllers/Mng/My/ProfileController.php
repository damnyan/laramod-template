<?php

namespace Modules\Administrator\Http\Controllers\Mng\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Administrator\Http\Requests\Mng\My\UpdateProfileRequest;
use Modules\Administrator\Http\Resources\Mng\My\ProfileResource;

/**
 * @tags Mng My Profile
 */
class ProfileController extends Controller
{
    /**
     * Show
     *
     * @param Request $request
     * @return ProfileResource
     */
    public function show(Request $request): ProfileResource
    {
        return new ProfileResource($request->user());
    }

    /**
     * Update
     *
     * @param UpdateProfileRequest $request
     * @return ProfileResource
     */
    public function update(UpdateProfileRequest $request): ProfileResource
    {
        $user = $request->user();
        $user->update($request->validated());

        return new ProfileResource($user);
    }
}
