<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyProjectsCollectionColorPallettesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('my_projects_collection_color_pallettes', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('collection_id')->unsigned()->index('collection_color_pallettes_collection_id_foreign');
			$table->text('color_img')->nullable();
			$table->string('color_name')->nullable();
			$table->string('brand')->nullable();
			$table->string('finish')->nullable();
			$table->string('application')->nullable();
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
		Schema::drop('my_projects_collection_color_pallettes');
	}

}
