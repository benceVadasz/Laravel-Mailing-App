<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user_from')->unsigned();
            $table->bigInteger('id_user_to')->unsigned();
            $table->foreign('id_user_from')->references('id')->on('users');
            $table->foreign('id_user_to')->references('id')->on('users');
            $table->string('subject');
            $table->string('message');
            $table->boolean('is_read')->default(0);
            $table->timestamp('sent')->default(date('Y-m-d H:i:s'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mails');
    }
}
