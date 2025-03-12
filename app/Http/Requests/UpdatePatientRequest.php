<?php

namespace App\Http\Requests;

use App\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePatientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'min:6',
                'max:15',
                'required',
                'unique:patients,pin_code,' . request()->route('patient')->id,
            ],
            'phone'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
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
            'office'      => [
                'required',
            ],
            'job_type'    => [
                'required',
            ],
            'department'  => [
                'required',
            ],
            'designation' => [
                'required',
            ],
        ];
    }
}
