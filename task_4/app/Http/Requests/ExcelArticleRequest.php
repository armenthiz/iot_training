<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelArticleRequest extends FormRequest
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
            'excel' => 'required|excel'
        ];
    }

    public function messages()
    {
        return [
            'excel.required' => 'Excel File is required',
            'excel.excel' => 'Excel File is not valid'
        ];
    }
}
