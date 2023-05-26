<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fio', 191);
            $table->string('email', 191);
            $table->string('phone', 191)->nullable();
            $table->string('num_pass', 191);
            $table->string('password', 191);
            $table->string('remember_token', 100)->nullable();
            $table->unsignedBigInteger('rule_id');
            $table->unsignedBigInteger('special_id');
            $table->string('oklad', 191);
            $table->timestamps();

            $table->index(['fio']);
            $table->index(['email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
