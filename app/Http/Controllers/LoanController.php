<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoanService;
use Illuminate\Http\JsonResponse;
use App\Validator\LoanValidator;
class LoanController extends Controller
{
    private $loanValidator;

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
        $validate = $this->loanValidator->validateStoreRequest($request->all());
        if ($validate->fails()) {
            return response()->json([
                "status" => "fails",
                "message" => $validate->errors()
            ], 400);
        }

        $loanService = new LoanService();
        $result = $loanService->createNewLoan($request->all());
        return response()->json([
            "status" => "success",
            "data" => $result
        ]);
    }

    /**
     * Validate data input then call service update approve or reject loan.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function approveLoan(int $id, Request $request): JsonResponse
    {
        $validate = $this->loanValidator->validateApprove(array_merge($request->all(), ["id" => $id]));
        if ($validate->fails()) {
            return response()->json([
                "status" => "fails",
                "message" => $validate->errors()->first(),
                "errors" => $validate->errors()->toArray(),
            ], 400);
        }

        $loanService = new LoanService();
        $result = $loanService->approveOrReject($id, $request->all());

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
