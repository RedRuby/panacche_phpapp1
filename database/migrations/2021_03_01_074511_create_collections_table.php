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
            $table->unsignedBigInteger('customer_id');

            $table->string('title');
            $table->string('description')->nullable();
            $table->string('image_src')->nullable();
            $table->string('image_alt')->nullable();
            $table->boolean('published')->default(false);
            $table->string('room_type')->nullable();
            $table->string('room_style')->nullable();
            $table->string('room_budget')->nullable();
            $table->string('status')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
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
