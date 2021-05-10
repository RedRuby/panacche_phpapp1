<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('my_projects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('parent_design_id')->unsigned()->index('my_projects_parent_design_id_foreign');
			$table->bigInteger('customer_id')->unsigned()->index('my_projects_customer_id_foreign');
			$table->bigInteger('my_project_collection_id')->unsigned();
			$table->text('metafield');
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
		Schema::drop('my_projects');
	}

}
