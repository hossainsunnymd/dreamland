<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceSaveRequest extends FormRequest
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
            'service_category_id' => 'required|exists:service_categories,id',
            // 'service_image' => $this->hasFile('service_image') ? 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:100' : 'required|string',
            'rank' => 'required|integer|min:1|unique:services,rank,' . $this->route('id'),
        ];
    }
}
