<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyProjectsCollectionProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('my_projects_collection_products', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('my_project_id')->unsigned()->index('my_projects_collection_products_my_project_id_foreign');
			$table->bigInteger('product_id')->unsigned()->index('my_projects_collection_products_parent_product_id_foreign');
			$table->integer('quantity')->nullable();
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
		Schema::drop('my_projects_collection_products');
	}

}
