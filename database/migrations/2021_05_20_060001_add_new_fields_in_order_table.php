<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsInOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('fulfillment_status',['unfulfilled','fulfilled'])->default('unfulfilled')->after('tag');
            $table->string('financial_status')->default(null)->after('tag');
            $table->json('shopify_order_data')->default(null)->after('tag');
            $table->string('name', 500)->default(null)->after('tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('fulfillment_status');
            $table->dropColumn('financial_status');
            $table->dropColumn('shopify_order_data');
            $table->dropColumn('name');
        });
    }
}
