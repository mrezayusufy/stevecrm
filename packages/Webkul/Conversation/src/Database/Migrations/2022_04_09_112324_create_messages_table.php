<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'sid',
        // 'account_sid',
        // 'coneversation_sid',
        // 'body',
        // 'media',
        // 'author',
        // 'participant_sid',
        // 'delivery',
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sid');
            $table->string('account_sid');
            $table->string('conversation_sid');
            $table->json('delivery');
            $table->integer('index');
            $table->datetime('date_created');
            $table->datetime('date_updated');
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
        Schema::dropIfExists('messages');
    }
}
