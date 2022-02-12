<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;

class LoanValidator extends Validator{

    public function validateStoreRequest($input)
    {
        $rule = [
            'user_id' => 'required|integer',
            'amount' => 'required|numeric',
            'loan_term' => 'required|date_format:Y-m-d',
        ];
        return Validator::make($input, $rule);
    }

    public function validateApprove($input)
    {
        $rule = [
            'id' => 'required|integer',
            'approved_by' => 'required|integer',
            'approved_at' => 'required|date_format:Y-m-d',
        ];
        return Validator::make($input, $rule);
    }
}
