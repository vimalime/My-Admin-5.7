<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermalinkRequest;
use App\Http\Requests\StorePermalinkRequest;
use App\Http\Requests\UpdatePermalinkRequest;
use App\Models\Permalink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermalinkController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permalink_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permalinks = Permalink::all();

        return view('frontend.permalinks.index', compact('permalinks'));
    }

    public function create()
    {
        abort_if(Gate::denies('permalink_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.permalinks.create');
    }

    public function store(StorePermalinkRequest $request)
    {
        $permalink = Permalink::create($request->all());

        return redirect()->route('frontend.permalinks.index');
    }

    public function edit(Permalink $permalink)
    {
        abort_if(Gate::denies('permalink_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.permalinks.edit', compact('permalink'));
    }

    public function update(UpdatePermalinkRequest $request, Permalink $permalink)
    {
        $permalink->update($request->all());

        return redirect()->route('frontend.permalinks.index');
    }

    public function show(Permalink $permalink)
    {
        abort_if(Gate::denies('permalink_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.permalinks.show', compact('permalink'));
    }

    public function destroy(Permalink $permalink)
    {
        abort_if(Gate::denies('permalink_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permalink->delete();

        return back();
    }

    public function massDestroy(MassDestroyPermalinkRequest $request)
    {
        Permalink::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
