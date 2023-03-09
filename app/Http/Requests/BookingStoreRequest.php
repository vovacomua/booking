<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
        ];
    }
}
