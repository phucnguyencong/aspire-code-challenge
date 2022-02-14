<?php

namespace App\Transformers;

use App\Models\Loan;
use League\Fractal\TransformerAbstract;

class LoanTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Loan $loan)
    {
        return [
            "id" => $loan->id,
            "amount" => $loan->amount,
            "loan_term" => $loan->loan_term,
            "approved_by" => $loan->approved_by,
            "approved_at" => $loan->approved_at,
        ];
    }
}
