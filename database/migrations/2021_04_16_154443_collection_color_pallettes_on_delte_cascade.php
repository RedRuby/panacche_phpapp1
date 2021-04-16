<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CollectionColorPallettesOnDelteCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_color_pallettes', function ($table) {
            //$table->unsignedBigInteger('collection_id');
            $table->dropForeign(['collection_id']);
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collection_color_pallettes', function($table) {
            $table->dropColumn('collection_id');
        });
    }
}