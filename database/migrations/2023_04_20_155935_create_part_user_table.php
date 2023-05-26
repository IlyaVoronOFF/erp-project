<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('object_parts_id');
            $table->unsignedBigInteger('object_parts_object_id');
            $table->dateTime('date', 1);
            $table->string('time', 191);
            $table->text('description', 255)->nullable();
            $table->timestamps();

            $table->index(['time', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_user');
    }
}