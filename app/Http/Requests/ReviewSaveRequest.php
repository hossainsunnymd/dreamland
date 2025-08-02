<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewSaveRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'image' => $this->hasFile('image') ? 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:100' : 'required|string',
            'description' => 'required|string',
        ];
    }
}
