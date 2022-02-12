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
            "user_id" => Auth::id(),
            "amount" => $data["amount"],
            "loan_term" => $data["loan_term"]
        ];

        return $this->loanRepository->create($loanData);
    }


    /**
     * Allow approval or reject loan via current user login
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function approveOrReject($id, $data)
    {
        $loanData = [
            "approve_by" => Auth::id(),
            "approve_at" => $data["is_approve"] ? Carbon::now() : null, // Check approve or reject
        ];

        if($this->loanRepository->update($id, $loanData)) {
            return $this->loanRepository->find($id);
        }
        return false;
    }
}
