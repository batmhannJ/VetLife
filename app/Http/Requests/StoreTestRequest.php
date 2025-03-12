<?php

namespace App\Http\Requests;

use App\Test;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('test_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'patients.*'     => [
                'integer',
            ],
            'patients'       => [
                'array',
            ],
            'blood_pressure' => [
                'min:6',
                'max:15',
            ],
            'heart_rate'     => [
                'min:2',
                'max:3',
            ],
        ];
    }
}
