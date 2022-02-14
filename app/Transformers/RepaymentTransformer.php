<?php

namespace App\Transformers;

use App\Models\Repayment;
use League\Fractal\TransformerAbstract;

class RepaymentTransformer extends TransformerAbstract
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
    public function transform(Repayment $repayment)
    {
        return [
            "id" => $repayment->id,
            "loan_id" => $repayment->loan_id,
            "amount" => $repayment->amount,
            "repaid_at" => $repayment->repaid_at
        ];
    }
}
