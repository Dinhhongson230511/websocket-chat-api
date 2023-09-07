<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('channel_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->text('message')->nullable();
            $table->text('images')->nullable();
            $table->text('attachments')->nullable();
            $table->string('type')->comment('メッセージ, 画像, 添付ファイル');
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
        Schema::drop('channel_messages');
    }
};
