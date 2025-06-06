<?php

namespace App\Http\Requests;

use App\Medicine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreMedicineRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('medicine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'item_code'     => [
                'required',
                'unique:medicines',
            ],
            'name'          => [
                'required',
                'unique:medicines',
            ],
            'type'          => [
                'required',
            ],
            'uos'           => [

            ],
            'received_from' => [
                'required',
            ],
            'qty_received'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'date_received' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'expiry_date'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
