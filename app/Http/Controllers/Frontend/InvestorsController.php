<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvestorRequest;
use App\Http\Requests\StoreInvestorRequest;
use App\Http\Requests\UpdateInvestorRequest;
use App\Models\Investor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvestorsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('investor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $investors = Investor::with(['created_by'])->get();

        return view('frontend.investors.index', compact('investors'));
    }

    public function create()
    {
        abort_if(Gate::denies('investor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.investors.create');
    }

    public function store(StoreInvestorRequest $request)
    {
        $investor = Investor::create($request->all());

        return redirect()->route('frontend.investors.index');
    }

    public function edit(Investor $investor)
    {
        abort_if(Gate::denies('investor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $investor->load('created_by');

        return view('frontend.investors.edit', compact('investor'));
    }

    public function update(UpdateInvestorRequest $request, Investor $investor)
    {
        $investor->update($request->all());

        return redirect()->route('frontend.investors.index');
    }

    public function show(Investor $investor)
    {
        abort_if(Gate::denies('investor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $investor->load('created_by');

        return view('frontend.investors.show', compact('investor'));
    }

    public function destroy(Investor $investor)
    {
        abort_if(Gate::denies('investor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $investor->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvestorRequest $request)
    {
        Investor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
