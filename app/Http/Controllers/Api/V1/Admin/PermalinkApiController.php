<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermalinkRequest;
use App\Http\Requests\UpdatePermalinkRequest;
use App\Http\Resources\Admin\PermalinkResource;
use App\Models\Permalink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermalinkApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permalink_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PermalinkResource(Permalink::all());
    }

    public function store(StorePermalinkRequest $request)
    {
        $permalink = Permalink::create($request->all());

        return (new PermalinkResource($permalink))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Permalink $permalink)
    {
        abort_if(Gate::denies('permalink_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PermalinkResource($permalink);
    }

    public function update(UpdatePermalinkRequest $request, Permalink $permalink)
    {
        $permalink->update($request->all());

        return (new PermalinkResource($permalink))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Permalink $permalink)
    {
        abort_if(Gate::denies('permalink_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permalink->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
