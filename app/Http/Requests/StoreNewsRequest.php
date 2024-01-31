<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|unique:news,title',
                'content' => 'required',
                'category_id' => 'required|integer',
                'image' => 'required|mimes:jpeg,png,jpg,gif',
                'tags' => 'required|string'
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'required|integer',
                'tags' => 'required|string',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif',
            ];
        }
    }
}
