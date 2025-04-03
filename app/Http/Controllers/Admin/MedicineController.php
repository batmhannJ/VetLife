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
    $medicines = Medicine::with(['prescriptions'])
        ->get()
        ->map(function ($medicine) {
            // Kunin ang total quantity issued mula sa prescriptions table
            $totalIssued = $medicine->prescriptions->sum('quantity_issued');

            // Kalkulahin ang natitirang stock
            $medicine->uos = max($medicine->qty_received - $totalIssued, 0);

            return $medicine;
        });

    return view('admin.medicines.index', compact('medicines'));
}


    public function create()
    {
        abort_if(Gate::denies('medicine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.medicines.create');
    }

    public function store(StoreMedicineRequest $request)
    {
        $data = $request->all();
        
        // Set uos equal to qty_received initially
        if (isset($data['qty_received'])) {
            $data['uos'] = $data['qty_received'];
        }
        
        $medicine = Medicine::create($data);
    
        return redirect()->route('admin.medicines.index');
    }

    public function edit(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.medicines.edit', compact('medicine'));
    }

    public function update(UpdateMedicineRequest $request, Medicine $medicine)
{
    $data = $request->all();
    
    // If qty_received is being updated, adjust uos accordingly
    if (isset($data['qty_received'])) {
        // Get current total issued
        $totalIssued = $medicine->prescriptions->sum('quantity_issued');
        
        // Calculate new uos value
        $data['uos'] = max($data['qty_received'] - $totalIssued, 0);
    }
    
    $medicine->update($data);

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
