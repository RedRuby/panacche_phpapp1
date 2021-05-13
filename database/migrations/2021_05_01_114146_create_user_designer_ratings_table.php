<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDesignerRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_designer_ratings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
			$table->unsignedBigInteger('designer_id');
            $table->foreign('designer_id')->references('id')->on('collections');
			$table->unsignedBigInteger('my_project_collection_id');
			$table->integer('rating');
			$table->text('review')->nullable();
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
		Schema::drop('user_designer_ratings');
	}

}
