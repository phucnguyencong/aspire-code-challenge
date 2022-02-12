<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;

class LoanValidator extends Validator{

    public function validateStoreRequest($input)
    {
        $rule = [
            'amount' => 'required|numeric',
            'loan_term' => 'required|date',
        ];
        return Validator::make($input, $rule);
    }

    public function validateApprove($input)
    {
        $rule = [
            'id' => 'required|integer',
            'is_approve' => 'required|boolean',
        ];
        return Validator::make($input, $rule);
    }
}
