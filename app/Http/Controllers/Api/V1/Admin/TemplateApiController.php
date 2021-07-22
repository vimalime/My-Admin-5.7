<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Http\Resources\Admin\TemplateResource;
use App\Models\Template;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TemplateApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TemplateResource(Template::with(['created_by'])->get());
    }

    public function store(StoreTemplateRequest $request)
    {
        $template = Template::create($request->all());

        return (new TemplateResource($template))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Template $template)
    {
        abort_if(Gate::denies('template_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TemplateResource($template->load(['created_by']));
    }

    public function update(UpdateTemplateRequest $request, Template $template)
    {
        $template->update($request->all());

        return (new TemplateResource($template))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Template $template)
    {
        abort_if(Gate::denies('template_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $template->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
