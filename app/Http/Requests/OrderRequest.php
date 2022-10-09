<?php

namespace App\Http\Requests;

use App\Abstracts\DecoratedValidator;
use Illuminate\Contracts\Validation\Validator;

class OrderRequest extends DecoratedValidator
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return array_merge([
            '*.id' => 'required|integer',
            '*.customerId' => 'required|integer',
            '*.items.*.productId' => 'required|integer',
            '*.items.*.quantity' => 'required|integer',
            '*.items.*.unitPrice' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
            '*.items.*.total' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
            '*.total' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
        ]);
    }

    protected function withValidator(Validator $validator): void
    {
        // TODO: Implement withValidator() method.
    }
}
