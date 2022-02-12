<?php

namespace App\Services;

use App\Models\Repayment;
use App\Repositories\Eloquent\RepaymentRepository;
use Carbon\Carbon;

class RepaymentService {

    private RepaymentRepository $repaymentRepository;

    public function __construct()
    {
        $this->repaymentRepository = new RepaymentRepository();
    }


    /**
     * Create new repayment with loan id
     *
     * @param $data
     * @return \App\Models\Repayment
     */
    public function createNewRepayment($data): Repayment
    {
        $loanData = [
            "loan_id" => $data["loan_id"],
            "amount" => $data["amount"],
            "repaid_at" => Carbon::parse($data["repaid_at"])->format("Y-m-d")
        ];

        return $this->repaymentRepository->create($loanData);
    }
}
