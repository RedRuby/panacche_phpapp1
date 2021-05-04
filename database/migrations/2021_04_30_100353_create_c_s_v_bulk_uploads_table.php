<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCSVBulkUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_s_v_bulk_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');

            $table->text('file_name');
            $table->enum('status', ['pending','started_uploading','uploaded', 'upload_error']);

            $table->foreign('collection_id')->references('id')->on('collections');
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
        Schema::dropIfExists('c_s_v_bulk_uploads');
    }
}
