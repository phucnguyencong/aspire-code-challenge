<?php

namespace App\Http\Controllers;

use App\Services\RepaymentService;
use App\Validator\RepaymentValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    private RepaymentValidator $repaymentValidator;

    public function __construct()
    {
        $this->repaymentValidator = new RepaymentValidator();
    }

    /**
     * Validate data and create new repayment with loan id
     *
     * @param int $loanId
     * @param Request $request
     * @return JsonResponse
     */
    public function createRepay(int $loanId, Request $request): JsonResponse
    {
        $input = array_merge($request->all(), ["loan_id" => $loanId]);
        $validate = $this->repaymentValidator->validateCreateRepayRequest($input);
        if ($validate->fails()) {
            return response()->json([
                "status" => "fails",
                "message" => $validate->errors()->first(),
                "errors" => $validate->errors()->toArray(),
            ], 400);
        }

        $repaymentService = new RepaymentService();
        $result = $repaymentService->createNewRepayment($input);

        return response()->json([
            "status" => "success",
            "data" => $result
        ]);
    }
}
