<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('duration')->nullable();
            $table->string('location')->nullable();
            $table->string('assign_to')->nullable();
            $table->string('link_to')->nullable();
            $table->string('notification_from')->nullable();
            $table->boolean('send_notification')->nullable();
            $table->string('associate_with')->nullable();
            $table->string('invite')->nullable();
            $table->text('notes')->nullable();
            $table->json('subtask')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
