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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->tinyInteger('is_seen')->default(0)->comment('0=unseen, 1=unread');
            $table->bigInteger('chat_room_id')->unsigned()->nullable();
            $table->string('type', 50)->nullable();
            $table->string('file_type', 20)->nullable();
            $table->tinyInteger('is_file')->default(0)->comment('1=file, 0=not file');
            $table->text('file')->nullable();
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
};
