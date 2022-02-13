<?php

namespace Tests\Unit\Service;

use App\Models\Loan;
use App\Models\Repayment;
use App\Services\RepaymentService;
use Carbon\Carbon;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class RepaymentServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    protected Loan $loan;
    protected RepaymentService $repaymentService;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->loan = Loan::create([
            "user_id" => User::where("name", "debtor")->first()->id,
            "amount" => $this->faker->numerify('####.##'),
            "loan_term" => Carbon::now()->addDay(90)->format('Y-m-d'),
            "approved_by" => User::where("name", "creditor")->first()->id,
            "approved_at" => Carbon::now()->format("Y-m-d")
        ]);
        $this->repaymentService = new RepaymentService();
    }

    /**
     * Test create new repayment for debtor success
     *
     * @return void
     */
    public function test_create_new_repayment_success()
    {
        $arguments = [
            "loan_id" => $this->loan->id,
            "amount" => $this->faker->numerify("##.##"),
            "repaid_at" => Carbon::now()->format("Y-m-d")
        ];
        $repayment = $this->repaymentService->createNewRepayment($arguments);

        $this->assertInstanceOf(Repayment::class, $repayment);

        $this->assertEquals($arguments["loan_id"], $repayment->loan_id);
        $this->assertEquals($arguments["amount"], $repayment->amount);
        $this->assertEquals($arguments["repaid_at"], $repayment->repaid_at);

        $this->assertDatabaseHas(app(Repayment::class)->getTable(), $arguments);
    }
}
