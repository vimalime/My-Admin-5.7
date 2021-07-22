<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvestorRequest;
use App\Http\Requests\StoreInvestorRequest;
use App\Http\Requests\UpdateInvestorRequest;
use App\Models\Investor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvestorsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('investor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Investor::with(['created_by'])->select(sprintf('%s.*', (new Investor())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'investor_show';
                $editGate = 'investor_edit';
                $deleteGate = 'investor_delete';
                $crudRoutePart = 'investors';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Investor::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.investors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('investor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.investors.create');
    }

    public function store(StoreInvestorRequest $request)
    {
        $investor = Investor::create($request->all());

        return redirect()->route('admin.investors.index');
    }

    public function edit(Investor $investor)
    {
        abort_if(Gate::denies('investor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $investor->load('created_by');

        return view('admin.investors.edit', compact('investor'));
    }

    public function update(UpdateInvestorRequest $request, Investor $investor)
    {
        $investor->update($request->all());

        return redirect()->route('admin.investors.index');
    }

    public function show(Investor $investor)
    {
        abort_if(Gate::denies('investor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $investor->load('created_by', 'investorLinkReviews', 'investorLinkSliders');

        return view('admin.investors.show', compact('investor'));
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
