<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Http\Resources\Admin\PrescriptionResource;
use App\Prescription;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrescriptionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prescription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrescriptionResource(Prescription::with(['patients', 'drug'])->get());
    }

    public function store(StorePrescriptionRequest $request)
    {
        $prescription = Prescription::create($request->all());
        $prescription->patients()->sync($request->input('patients', []));

        return (new PrescriptionResource($prescription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Prescription $prescription)
    {
        abort_if(Gate::denies('prescription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrescriptionResource($prescription->load(['patients', 'drug']));
    }

    public function update(UpdatePrescriptionRequest $request, Prescription $prescription)
    {
        $prescription->update($request->all());
        $prescription->patients()->sync($request->input('patients', []));

        return (new PrescriptionResource($prescription))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Prescription $prescription)
    {
        abort_if(Gate::denies('prescription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prescription->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
