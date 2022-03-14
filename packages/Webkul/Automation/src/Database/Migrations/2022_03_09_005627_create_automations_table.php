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
            $table->string('days_after')->nullable();
            $table->string('send_time')->nullable();
            $table->string('include_tag_ids')->nullable();
            $table->string('exclude_tags_ids')->nullable();
            $table->string('recipient')->nullable();
            $table->string('send')->nullable();

            $table->integer('lead_pipeline_stage_id')->unsigned();
            $table->foreign('lead_pipeline_stage_id')->references('id')->on('lead_pipeline_stages')->onDelete('cascade');

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
