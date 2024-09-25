<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMusicianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',

            'birth_date'=>'required',
            'instrument'=>'required',
            'biography'=>'required',
        ];
    }
    public function messages():array
    {
        return [
            'name.required'=>'Không được để trống name',
           
            'birth_date.required'=>'Không được để trống birth_date',
            'instrument.required'=>'Không được để trống instrument',
            'biography.required'=>'Không được để trống biography',
        ];
    }
}
