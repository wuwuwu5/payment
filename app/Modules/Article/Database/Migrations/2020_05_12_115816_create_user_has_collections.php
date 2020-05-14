<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_collections', function (Blueprint $table) {
            $table->id()->comment("用户的收藏");
            $table->unsignedBigInteger('user_id')->comment("用户ID");
            $table->unsignedBigInteger('favorite_id')->comment("收藏夹ID");
            $table->unsignedBigInteger('model_id')->comment("model id");
            $table->string('model_type')->comment("model type");
            $table->timestamps();

            $table->index(['user_id', 'favorite_id']);
            $table->index(['model_id', 'model_type']);

            // 设置外键
            $table->foreign('favorite_id')
                ->references('id')
                ->on('user_has_favorites')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_collections');
    }
}
