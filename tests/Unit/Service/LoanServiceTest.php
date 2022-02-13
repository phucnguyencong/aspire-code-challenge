<?php

namespace Tests\Unit\Service;

use App\Models\Loan;
use App\Services\LoanService;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class LoanServiceTest extends TestCase
{
    use WithFaker;
    protected array $loanData;
    protected LoanService $loanService;
    protected User $debtorUser;
    protected User $creditorUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->debtorUser = User::where("name", "debtor")->first();
        $this->creditorUser = User::where("name", "creditor")->first();
        $this->loanData = [
            "user_id" => $this->debtorUser->id,
            "amount" => $this->faker->numerify('####.##'),
            "loan_term" => Carbon::now()->addDay(90)->format('Y-m-d'),
        ];
        $this->loanService = new LoanService();
    }

    /**
     * Test service create new loan by debtor success.
     *
     * @return void
     */
    public function test_create_new_loan_success()
    {
        $loan = $this->loanService->createNewLoan($this->loanData);

        $this->assertInstanceOf(Loan::class, $loan);

        $this->assertEquals($this->loanData["user_id"], $loan->user_id);
        $this->assertEquals($this->loanData["amount"], $loan->amount);
        $this->assertEquals($this->loanData["loan_term"], $loan->loan_term);

        $this->assertDatabaseHas(app(Loan::class)->getTable(), $this->loanData);
    }

    /**
     * Test service approve loan by creditor success.
     *
     * @return void
     */
    public function test_approve_loan_success()
    {
        $loanObject = Loan::create($this->loanData);
        $arguments = [
            "id" => $loanObject->id,
            "approved_by" => $this->creditorUser->id,
            "approved_at" => Carbon::now()->format("Y-m-d")
        ];
        $loan = $this->loanService->approve($arguments);

        $this->assertInstanceOf(Loan::class, $loan);

        $this->assertEquals($this->loanData["user_id"], $loan->user_id);
        $this->assertEquals($this->loanData["amount"], $loan->amount);
        $this->assertEquals($this->loanData["loan_term"], $loan->loan_term);
        $this->assertEquals($arguments["approved_by"], $loan->approved_by);
        $this->assertEquals($arguments["approved_at"], $loan->approved_at);

        $this->assertDatabaseHas(app(Loan::class)->getTable(), array_merge($this->loanData, $arguments));
    }
}
