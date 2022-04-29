<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'title' => 'required|string',
            'tags' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Titulo es requerido',
            'tags.required' => 'Tags es requerido',
            'tags.array' => 'Tags debe ser un arreglo'
        ];
    }
}
