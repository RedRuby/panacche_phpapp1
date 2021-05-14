<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_projects_upload_documents', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('my_project_id');
            $table->tinyInteger('type')->default(0);
            $table->string('file_url', 500);
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
        Schema::dropIfExists('my_projects_upload_documents');
    }
}
