<?php

namespace App\Http\Requests;

use App\Abstracts\DecoratedValidator;
use App\Http\Middleware\Authenticate;
use Illuminate\Contracts\Validation\Validator;

class CategoryRequest extends DecoratedValidator
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            '*.name' => 'required'
        ];
    }

    protected function withValidator(Validator $validator): void
    {
        // TODO: Implement withValidator() method.
    }
}
