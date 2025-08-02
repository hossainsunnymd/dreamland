<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversitySaveRequest extends FormRequest
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
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'image' => $this->hasFile('image') ? 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:100' : 'required|string',
            'title' => 'required|string|max:255',
            'rank' => 'required|integer|min:1|unique:universities,rank,' . $this->route('id'),
        ];
    }
}
