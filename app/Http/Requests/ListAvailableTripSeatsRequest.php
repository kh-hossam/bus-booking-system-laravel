<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListAvailableTripSeatsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start_station_id' => ['required', 'exists:stations,id', 'different:end_station_id', 'lt:end_station_id'],
            'end_station_id' => ['required', 'exists:stations,id', 'different:start_station_id'],
        ];
    }
}
