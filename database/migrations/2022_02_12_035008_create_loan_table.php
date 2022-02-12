<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLoansTable.
 */
class CreateLoanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('loan', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->index();
            $table->decimal('amount', 10, 2);
            $table->bigInteger('approved_by')->nullable(true);
            $table->date('approved_at')->nullable(true);
            $table->date('loan_term')->nullable(false);
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('loan');
	}
}
