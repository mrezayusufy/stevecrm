<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'sid',
        // 'chat_service_sid',
        // 'messaging_service_sid',
        // 'account_sid',
        // 'attributes',
        // 'friendly_name',
        // 'unique_name',
        // 'state',
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sid');
            $table->string('chat_service_sid');
            $table->string('messaging_service_sid');
            $table->string('account_sid');
            $table->json('attributes');
            $table->string('friendly_name');
            $table->string('unique_name')->nullable();
            $table->string('state');
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
        Schema::dropIfExists('conversations');
    }
}
