<?php

namespace Modules\Administrator\Http\Controllers\Mng;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Modules\Administrator\Http\Requests\Mng\StoreRequest;
use Modules\Administrator\Http\Requests\Mng\UpdateRequest;
use Modules\Administrator\Http\Resources\Mng\AdministratorResource;
use Modules\Administrator\Models\Administrator;
use Modules\Common\Http\Controllers\Controller as BaseController;

/**
 * @tags Mng Administrator
 */
class CrudController extends BaseController
{
    /**
     * Index
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $administrators = Administrator::paginate(perPage: $this->getPerPage());

        return AdministratorResource::collection(resource: $administrators);
    }

    /**
     * Store
     *
     * @param StoreRequest $request
     * @return AdministratorResource
     */
    public function store(StoreRequest $request): AdministratorResource
    {
        $administrators = Administrator::create(attributes: $request->validated());
        $administrators->syncRoles($request->roles);

        return new AdministratorResource($administrators);
    }

    /**
     * Show
     *
     * @param Administrator $administrator
     * @return AdministratorResource
     */
    public function show(Administrator $administrator): AdministratorResource
    {
        return new AdministratorResource(resource: $administrator);
    }

    /**
     * update
     *
     * @param UpdateRequest $request
     * @param Administrator $administrator
     * @return void
     */
    public function update(UpdateRequest $request, Administrator $administrator)
    {
        $administrator->update(attributes: $request->validated());
        $administrator->syncRoles($request->roles);

        return new AdministratorResource(resource: $administrator);
    }

    /**
     * Destroy
     *
     * @param Administrator $administrator
     * @return Response
     */
    public function destroy(Administrator $administrator): Response
    {
        $administrator->delete();

        return response()->noContent();
    }
}
