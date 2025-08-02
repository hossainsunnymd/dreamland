<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageContentSaveRequest extends FormRequest
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
            'page_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rank' => 'required|integer|unique:pages,rank,' . $this->route('id'),
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'image' => $this->hasFile('image') ? 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:100' : 'required|string',
        ];
    }
}
