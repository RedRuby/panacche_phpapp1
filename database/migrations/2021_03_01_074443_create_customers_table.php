<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('password');
            $table->enum('status', ['pending', 'active', 'disabled']);
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('locality')->nullable();
            $table->string('city');
            $table->string('zip');
            $table->string('state')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('profile_type')->nullable();
            $table->text('profile_picture')->nullable();
            $table->text('designer_certificate')->nullable();
            $table->text('communication_channels')->nullable();
            $table->string('tag');
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
        Schema::dropIfExists('customers');
    }
}
