<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('user_type', 10)->default('User')->nullable();
            $table->string('phone', 100);
            $table->integer('otp');
            $table->tinyInteger('is_used')->default(0);
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
        Schema::dropIfExists('secretes');
    }
}
