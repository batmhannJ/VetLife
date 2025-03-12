<?php

namespace App\Http\Requests;

use App\Prescription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePrescriptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prescription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'patients.*'      => [
                'integer',
            ],
            'patients'        => [
                'required',
                'array',
            ],
            'drug_id'         => [
                'required',
                'integer',
            ],
            'quantity_issued' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'date_issued'     => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
