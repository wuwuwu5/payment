<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('top_id')->unsigned()->default(0)->index('top_id')->comment('顶级');
            $table->unsignedBigInteger('pid')->unsigned()->default(0)->index('pid')->comment('父ID');
            $table->unsignedBigInteger('category_group_id')->comment('群组');
            $table->string('path', 100)->nullable()->default('');
            $table->string('name', 30)->default('');
            $table->string('nickname', 50)->default('');
            $table->string('flag')->default('');
            $table->string('image', 100)->nullable()->default('')->comment('图片或者ICON');
            $table->string('keywords')->default('')->comment('关键字');
            $table->string('description')->default('')->comment('描述');
            $table->integer('weigh')->default(0)->comment('权重');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0 禁用 1 启用');
            $table->json('value')->nullable()->comment('JSON,自定义扩展');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['weigh', 'id'], 'weigh');
            $table->index('category_group_id');
            $table->index('pid');
            $table->index('top_id');
            $table->index('path');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
