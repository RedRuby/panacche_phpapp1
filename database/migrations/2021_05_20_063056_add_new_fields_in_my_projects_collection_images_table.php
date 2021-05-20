<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsInMyProjectsCollectionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_projects_collection_images', function (Blueprint $table) {
            $table->tinyInteger('concept_board')->default(0)->after('img_alt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_projects_collection_images', function (Blueprint $table) {
            $table->dropColumn('concept_board');
        });
    }
}
