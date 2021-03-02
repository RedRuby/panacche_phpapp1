<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');

            $table->string('title');
            $table->string('description')->nullable();
            $table->text('body')->nullable();
            $table->string('vendor')->nullable();
            $table->string('product_type')->nullable();
            $table->boolean('published')->default(false);
            $table->string('room_type')->nullable();
            $table->string('room_style')->nullable();
            $table->string('room_budget')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('products');
    }
}
