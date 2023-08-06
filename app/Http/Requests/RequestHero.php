<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RequestHero extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:10',
            'subtitle' => 'required|min:10|max:50',
            'background' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Kolom TITLE tidak boleh kosong om !',
            'title.min' => 'Kolom TITLE terlalu pendek !',
            'title.max' => 'Kolom TITLE terlalu panjang !',
            'subtitle.required' => 'Kolom SUBTITLE tidak boleh kosong om !',
            'subtitle.min' => 'Kolom SUBTITLE terlalu pendek !',
            'subtitle.max' => 'Kolom SUBTITLE terlalu panjang !',
            'background.required' => 'Kolom BACKGROUND tidak boleh kosong !',
            'background.image' => 'Kolom BACKGROUND harus file image !',
            'background.mimes' => 'File pada kolom BACKGROUND harus jpeg, png, gif atau svg !',
            'background.max' => 'File pada kolom BACKGROUND terlalu besar !',
        ];
    }
}
