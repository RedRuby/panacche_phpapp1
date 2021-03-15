<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionColorPallettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_color_pallettes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');
            $table->text('color_img')->nullable();
            $table->string('color_name')->nullable();
            $table->string('brand')->nullable();
            $table->string('finish')->nullable();
            $table->string('application')->nullable();


            $table->timestamps();
            $table->foreign('collection_id')->references('id')->on('collections');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_color_pallettes');
    }
}
