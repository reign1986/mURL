<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        $schemaBuilder = app('db')->connection()->getSchemaBuilder();

        return [
            'url' => [
                'required',
                'url',
                'max:' . $schemaBuilder::$defaultStringLength,
            ],
        ];
    }
}
