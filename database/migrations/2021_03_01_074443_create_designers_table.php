<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->enum('status', ['pending', 'active', 'disabled']);
            $table->string('phone');
            $table->text('display_picture')->nullable();
            $table->text('bio')->nullable();
            $table->text('quote')->nullable();
            $table->string('business_name')->nullable();;
            $table->text('business_address')->nullable();;
            $table->string('website_url')->nullable();
            $table->text('resume');
            $table->text('portfolio');
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
        Schema::dropIfExists('designers');
    }
}
