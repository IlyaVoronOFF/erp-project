<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('object_id');
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('user_id');
            $table->string('daterange', 191);
            $table->string('time', 191);
            $table->string('fot_part', 191);
            $table->text('description', 255)->nullable();
            $table->timestamps();

            $table->index(['object_id', 'part_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('object_parts');
    }
}
