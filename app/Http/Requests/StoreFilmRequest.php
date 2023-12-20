<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'image' => 'required|file|mimes:jpeg,png|max:2048',
            'release_date' => 'required|date',
            'end_date' => 'required|date',
            'runtime' => 'required|numeric',
            'age_validation' => 'required|string',
            'genre' => 'required|string',
            'director' => 'required|string',
            'actor' => 'required|string'
        ];
    }
}
