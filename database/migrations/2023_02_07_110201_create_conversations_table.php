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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('to_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->tinyInteger('status')->default(0)->comment('0 for unread,1 for seen');
            $table->tinyInteger('message_type')->default(0)->comment('0- text message, 1- image, 2- pdf, 3- doc, 4- voice');
            $table->text('file_name')->nullable();
            $table->json('url_details');
            $table->foreignId('reply_to')->constrained('users')->onDelete('cascade');
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
};
