<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191);
            $table->string('code', 191);
            $table->string('daterange', 191);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stage_id');
            $table->unsignedBigInteger('project_sum');
            $table->unsignedBigInteger('plan_fot');
            $table->unsignedBigInteger('archive')->default(0);
            $table->text('address', 255);
            $table->text('description', 255)->nullable();
            $table->timestamps();

            $table->index(['title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objects');
    }
}
