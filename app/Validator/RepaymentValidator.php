<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;

class RepaymentValidator extends Validator{

    public function validateCreateRepayRequest($input)
    {
        $rule = [
            'loan_id' => 'required|integer',
            'amount' => 'required|numeric',
            'repaid_at' => 'required|date_format:Y-m-d',
        ];
        return Validator::make($input, $rule);
    }
}
