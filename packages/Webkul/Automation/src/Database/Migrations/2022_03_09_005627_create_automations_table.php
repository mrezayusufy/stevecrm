<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('type');
            $table->text('comment')->nullable();
            $table->text('location')->nullable();
            $table->json('additional')->nullable();
            $table->datetime('schedule_from')->nullable();
            $table->datetime('schedule_to')->nullable();
            $table->boolean('is_done')->default(0);
            $table->string('at_period')->nullable();
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
        Schema::dropIfExists('automations');
    }
}
