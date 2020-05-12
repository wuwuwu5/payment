<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasFavorites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_favorites', function (Blueprint $table) {
            $table->id()->comment("用户拥有的收藏夹");
            $table->unsignedBigInteger('user_id')->comment("用户ID");
            $table->string('name', 50)->comment("收藏夹名称");
            $table->timestamps();
            // 唯一索引
            $table->unique(['user_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_favorites');
    }
}
