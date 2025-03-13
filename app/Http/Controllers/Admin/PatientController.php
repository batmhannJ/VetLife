<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Patient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all();

        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patients.create');
    }

    public function store(StorePatientRequest $request)
{
    // Create patient with validated data
    $patient = Patient::create([
        'last_name' => $request->input('last_name'),
        'first_name' => $request->input('first_name'),
        'gender' => $request->input('gender'),
        'dob' => $request->input('dob'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'pin_code' => $request->input('pin_code'),
        'blood_group' => $request->input('blood_group'),
        'emergency_contact_name' => $request->input('emergency_contact_name'),
        'emergency_contact_relationship' => $request->input('emergency_contact_relationship'),
        'emergency_contact_phone' => $request->input('emergency_contact_phone'),
        'emergency_contact_address' => $request->input('emergency_contact_address'),
    ]);

    // Handle photo upload
    if ($request->input('photo', false)) {
        $patient->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))
               ->toMediaCollection('photo');
    }

    return redirect()->route('admin.patients.index')->with('message', 'Patient created successfully');
}

    public function edit(Patient $patient)
    {
        abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patients.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->all());

        if ($request->input('photo', false)) {
            if (!$patient->photo || $request->input('photo') !== $patient->photo->file_name) {
                $patient->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($patient->photo) {
            $patient->photo->delete();
        }

        return redirect()->route('admin.patients.index');
    }

    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patients.show', compact('patient'));
    }

    public function destroy(Patient $patient)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientRequest $request)
    {
        Patient::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
