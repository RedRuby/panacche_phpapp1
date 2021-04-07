<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('designer_id');

            $table->string('design_name');
            $table->text('implementation_guide_description')->nullable();
            $table->string('image_src')->nullable();
            $table->string('image_alt')->nullable();
            $table->boolean('published')->default(false);
            $table->string('room_type')->nullable();
            $table->string('room_style')->nullable();
            $table->string('room_budget')->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected']);
            $table->string('design_implementation_guide')->nullable();
            $table->string('room_width_in_feet')->nullable();
            $table->string('room_width_in_inches')->nullable();
            $table->string('room_height_in_feet')->nullable();
            $table->string('room_height_in_inches')->nullable();
            $table->string('design_price')->nullable();
            $table->string('pet_friendly_design')->nullable();

            $table->foreign('designer_id')->references('id')->on('designers');
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
        Schema::dropIfExists('collections');
    }
}
