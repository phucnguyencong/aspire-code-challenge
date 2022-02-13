<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanTest extends TestCase
{
    use WithFaker;
    private User $debtorUser;
    private User $creditorUser;
    private array $loanData;

    public function setUp(): void
    {
        parent::setUp();
        $this->debtorUser = User::where("name", "debtor")->first();
        $this->creditorUser = User::where("name", "creditor")->first();
        $this->loanData = [
            'user_id' => $this->debtorUser->id,
            "amount" => $this->faker->numerify('###.##'),
            "loan_term" => Carbon::now()->addDay(90)->format('Y-m-d'),
        ];
    }

    public function test_create_new_loan_success()
    {
        $response = $this->actingAs($this->debtorUser, 'api')
            ->postJson('/api/loan', $this->loanData);

        $response->assertStatus(200);
        $response->assertJson([
            "status"=> "success",
            "data"=> [
                "user_id"=> $this->debtorUser->id,
                "amount"=> $this->loanData["amount"],
                "loan_term"=> $this->loanData["loan_term"]
            ]
        ]);
    }

    public function test_approve_loan_success()
    {
        $loan = Loan::create($this->loanData);
        $payload = [
            "approved_at" => Carbon::now()->format('Y-m-d'),
        ];

        $response = $this->actingAs($this->creditorUser, 'api')
            ->patchJson("/api/loan/{$loan->id}/approval", $payload);

        $response->assertStatus(200);
        $response->assertJson([
            "status"=> "success",
            "data"=> [
                "approved_at"=> $payload["approved_at"],
                "approved_by"=> $this->creditorUser->id
            ]
        ]);
    }

    public function test_create_repay_success()
    {
        $loan = Loan::create(array_merge($this->loanData, [
            "approved_by"=> $this->creditorUser->id,
            "approved_at" => Carbon::now()->format('Y-m-d'),
        ]));

        $payload = [
            "amount" => $this->faker->numerify('##.##'),
            "repaid_at" => Carbon::now()->format('Y-m-d')
        ];

        $response = $this->actingAs($this->debtorUser, 'api')
            ->postJson("/api/loan/{$loan->id}/repayment", $payload);

        $response->assertStatus(200);
        $response->assertJson([
            "status"=> "success",
            "data"=> [
                "amount"=> $payload["amount"],
                "repaid_at"=> $payload["repaid_at"]
            ]
        ]);
    }
}
