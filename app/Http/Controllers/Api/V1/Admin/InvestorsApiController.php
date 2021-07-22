<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvestorRequest;
use App\Http\Requests\UpdateInvestorRequest;
use App\Http\Resources\Admin\InvestorResource;
use App\Models\Investor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvestorsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('investor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvestorResource(Investor::with(['created_by'])->get());
    }

    public function store(StoreInvestorRequest $request)
    {
        $investor = Investor::create($request->all());

        return (new InvestorResource($investor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Investor $investor)
    {
        abort_if(Gate::denies('investor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvestorResource($investor->load(['created_by']));
    }

    public function update(UpdateInvestorRequest $request, Investor $investor)
    {
        $investor->update($request->all());

        return (new InvestorResource($investor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Investor $investor)
    {
        abort_if(Gate::denies('investor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $investor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
