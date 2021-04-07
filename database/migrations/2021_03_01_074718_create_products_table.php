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
            $table->text('description')->nullable();
            $table->boolean('published')->default(false);
            $table->string('size_specification')->nullable();
            $table->string('product_url')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_compare_at_price')->nullable();
            $table->string('product_quantity')->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected']);
            $table->unsignedBigInteger('vendor_id')->nullable();

            $table->foreign('collection_id')->references('id')->on('collections');
            $table->foreign('vendor_id')->references('id')->on('vendors');
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
