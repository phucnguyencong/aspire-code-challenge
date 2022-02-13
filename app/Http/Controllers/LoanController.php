<?php

namespace App\Http\Controllers;

use App\Services\RepaymentService;
use App\Validator\RepaymentValidator;
use Illuminate\Http\Request;
use App\Services\LoanService;
use Illuminate\Http\JsonResponse;
use App\Validator\LoanValidator;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    private LoanValidator $loanValidator;

    public function __construct()
    {
        $this->loanValidator = new LoanValidator();
    }
    /**
     * Validate data input then call service create new loan.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = array_merge($request->all(), [
           "user_id" => Auth::id()
        ]);
        $validate = $this->loanValidator->validateStoreRequest($input);
        if ($validate->fails()) {
            return response()->json([
                "status" => "fails",
                "message" => $validate->errors()
            ], 400);
        }

        $loanService = new LoanService();
        $result = $loanService->createNewLoan($input);
        return response()->json([
            "status" => "success",
            "data" => $result
        ]);
    }

    /**
     * Validate data input and approve loan with current user.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function approveLoan(int $id, Request $request): JsonResponse
    {
        $input = array_merge($request->all(), [
            "id" => $id,
            "approved_by" => Auth::id()
        ]);
        $validate = $this->loanValidator->validateApprove($input);
        if ($validate->fails()) {
            return response()->json([
                "status" => "fails",
                "message" => $validate->errors()->first(),
                "errors" => $validate->errors()->toArray(),
            ], 400);
        }

        $loanService = new LoanService();
        $result = $loanService->approve($input);

        if($result) {
            return response()->json([
                "status" => "success",
                "data" => $result
            ]);
        }
        return response()->json([
            "status" => "fails",
            "message" => "Can not approve loan."
        ]);
    }
}
