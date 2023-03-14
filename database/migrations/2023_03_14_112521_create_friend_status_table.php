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
        Schema::create('friend_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('friend_id');
            $table->foreign('friend_id')->references('id')->on('friends')->onDelete('CASCADE');
            $table->unsignedBigInteger('friend_statu_type_id');
            $table->foreign('friend_statu_type_id')->references('id')->on('friend_status_types')->onDelete('CASCADE');
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
        Schema::dropIfExists('friend_status');
    }
};
