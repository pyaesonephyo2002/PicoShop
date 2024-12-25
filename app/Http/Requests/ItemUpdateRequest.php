<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ItemUpdateRequest extends FormRequest
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
        'code_no' => 'required', // Fixed spacing and arrow operator
        'name' => 'required',    // Fixed spacing and arrow operator
        'price' => 'required',   // Corrected arrow operator
        'discount' => 'required', // Fixed arrow operator
        'instock' => 'required', // Corrected arrow operator
        'description' => 'required', // Fixed spacing and arrow operator
        'category_id' => 'required', // Corrected arrow operator
        ];
    }
}
