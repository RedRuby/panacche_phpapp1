<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyProjectsCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('my_projects_collections', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('designer_id')->unsigned()->index('collections_designer_id_foreign');
			$table->text('shopify_collection_id')->nullable();
			$table->text('handle')->nullable();
			$table->string('design_name');
			$table->text('implementation_guide_description')->nullable();
			$table->string('image_src')->nullable();
			$table->string('image_alt')->nullable();
			$table->boolean('published')->default(0);
			$table->string('room_type')->nullable();
			$table->string('room_style')->nullable();
			$table->string('room_budget')->nullable();
			$table->enum('status', array('draft','submitted','approved','rejected','reassign','abandoned'));
			$table->string('design_implementation_guide')->nullable();
			$table->string('room_width_in_feet')->nullable();
			$table->string('room_width_in_inches')->nullable();
			$table->string('room_height_in_feet')->nullable();
			$table->string('room_height_in_inches')->nullable();
			$table->string('design_price')->nullable();
			$table->string('pet_friendly_design')->nullable();
			$table->text('remark')->nullable();
			$table->dateTime('approved_on')->nullable();
			$table->dateTime('abandoned_on')->nullable();
			$table->text('metafields')->nullable();
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
		Schema::drop('my_projects_collections');
	}

}
