<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyProjectsChangeRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('my_projects_change_request', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->bigInteger('my_project_id');
			$table->tinyInteger('type')->default(0);
			$table->bigInteger('product_id');
			$table->string('file', 200);
			$table->bigInteger('color_id');
			$table->string('brand')->nullable()->default(null);
			$table->string('application')->nullable()->default(null);
			$table->string('finish')->nullable()->default(null);
			$table->text('change reason');
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
		Schema::drop('my_projects_change_request');
	}

}
