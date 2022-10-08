<?php

namespace App\Http\Requests;

use App\Abstracts\DecoratedValidator;
use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends DecoratedValidator
{

    public function rules():array
    {
        return [
            '*.name' => 'required',
            '*.category' => 'required|integer',
            '*.price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
            '*.stock' => 'required|integer'
        ];
    }

    protected function withValidator(Validator $validator): void
    {
        // TODO: Implement withValidator() method.
    }
}
