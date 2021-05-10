<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMyProjectsCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_projects_collections', function (Blueprint $table) {
            $table->foreign('designer_id')->references('id')->on('designers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_projects_collections', function (Blueprint $table) {
            $table->dropForeign('my_projects_collections_designer_id_foreign');
        });
    }
}
