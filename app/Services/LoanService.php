<?php

namespace App\Services;

use App\Models\Loan;
use App\Repositories\Eloquent\LoanRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoanService {

    private LoanRepository $loanRepository;

    public function __construct()
    {
        $this->loanRepository = new LoanRepository();
    }


    /**
     * Create new loan for current user login
     *
     * @param $data
     * @return \App\Models\Loan
     */
    public function createNewLoan($data): Loan
    {
        $loanData = [
            "user_id" => $data["user_id"],
            "amount" => $data["amount"],
            "loan_term" => Carbon::parse($data["loan_term"])->format("Y-m-d")
        ];

        return $this->loanRepository->create($loanData);
    }


    /**
     * Allow approval and track who is approved
     *
     * @param $data
     * @return mixed
     */
    public function approve($data)
    {
        $loanData = [
            "approved_by" => $data["approved_by"],
            "approved_at" => Carbon::parse($data["approved_at"])->format("Y-m-d")
        ];

        if($this->loanRepository->update($data["id"], $loanData)) {
            return $this->loanRepository->find($data["id"]);
        }
        return false;
    }
}
