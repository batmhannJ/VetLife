<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMedicineRequest;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Medicine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedicineController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicines = Medicine::all();

        return view('admin.medicines.index', compact('medicines'));
    }

    public function create()
    {
        abort_if(Gate::denies('medicine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.medicines.create');
    }

    public function store(StoreMedicineRequest $request)
    {
        $medicine = Medicine::create($request->all());

        return redirect()->route('admin.medicines.index');
    }

    public function edit(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.medicines.edit', compact('medicine'));
    }

    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update($request->all());

        return redirect()->route('admin.medicines.index');
    }

    public function show(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.medicines.show', compact('medicine'));
    }

    public function destroy(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine->delete();

        return back();
    }

    public function massDestroy(MassDestroyMedicineRequest $request)
    {
        Medicine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
