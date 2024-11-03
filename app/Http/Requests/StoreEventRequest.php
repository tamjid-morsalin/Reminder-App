<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => [
                'required'
            ],
            'start_date_time'    => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format')
            ],
            'registrants.*' => [
                'integer'
            ],
            'registrants'   => [
                'array'
            ],
        ];

    }
}
