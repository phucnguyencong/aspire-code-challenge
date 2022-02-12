<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLoansTable.
 */
class CreateLoansTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('loans', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->index();
            $table->decimal('amount', 10, 2);
            $table->decimal('remain_amount', 10, 2)->default(0);
            $table->bigInteger('approve_by')->nullable(true);
            $table->date('approve_at')->nullable(true);
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
		Schema::drop('loans');
	}
}
