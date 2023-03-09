<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'room_id' => 'exists:rooms,id',
            'starts_at' => 'date',
            'ends_at' => 'date|after:starts_at',
        ];
    }
}
