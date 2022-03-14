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
            $table->string('type')->nullable();
            $table->string('day_after')->nullable();
            $table->string('send_at')->nullable();
            $table->json('include_tags')->nullable();
            $table->json('exclude_tags')->nullable();
            $table->integer('sender')->unsigned();
            $table->integer('recipient')->unsigned();
            $table->integer('text_template_id')->unsigned();
            $table->foreign('text_template_id')->references('id')->on('text_templates')->onDelete('cascade');
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
