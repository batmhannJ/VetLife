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
                'max:15',
                'unique:patients,pin_code,' . request()->route('patient')->id,
            ],
            'phone'       => [
                'nullable',
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
            ],
            'job_type'    => [
            ],
            'department'  => [
            ],
            'designation' => [
            ],
        ];
    }
}
