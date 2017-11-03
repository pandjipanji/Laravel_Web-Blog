<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelRequest extends FormRequest
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
            'import' => 'required|mimes:xlsx,xls,csv,txt,ods'
            //'import' => 'required|mimeTypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,text/plain,application/vnd.oasis.opendocument.spreadsheet'
        ];
    }

    public function messages()
    {
        return [
            'import.mimes' => 'Must be a excel type of file'
        ];
    }
}
