<?php

namespace App\Http\Requests;

use App\Abstracts\DecoratedValidator;
use Illuminate\Contracts\Validation\Validator;

class CustomerRequest extends DecoratedValidator
{

    public function rules(): array
    {
        return array_merge([
            '*.name' => 'required',
            '*.revenue' => 'required',
            '*.since' => 'required|date_format:Y-m-d',
        ]);
    }

    protected function withValidator(Validator $validator): void
    {
        // TODO: Implement withValidator() method.
    }
}
