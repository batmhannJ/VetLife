<?php

namespace App\Http\Requests;

use App\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePatientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name'  => [
                'min:3',
                'max:20',
                'required',
            ],
            'last_name'   => [
                'min:3',
                'max:20',
                'required',
            ],
            'pin_code'    => [
                'min:1',
                'max:15',
                'required',
                'unique:patients',
            ],
            'phone'       => [
                'nullable',
                'string',
                'max:20',
            ],
            'gender'      => [
                'required',
            ],
            'address'     => [
                'required',
            ],
            'dob'         => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
