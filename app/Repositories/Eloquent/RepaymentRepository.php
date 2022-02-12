<?php

namespace App\Repositories\Eloquent;

use App\Models\Repayment;
use App\Repositories\Interfaces\RepaymentRepositoryInterface;

class RepaymentRepository implements RepaymentRepositoryInterface {

    /**
     * Create a new record in table Repayment
     *
     * @param array $data
     * @return Repayment
     */
    public function create(array $data): Repayment
    {
        return Repayment::create($data);
    }
}
