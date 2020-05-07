<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->comment("创建人");
            $table->unsignedBigInteger('category_id')->comment("分组ID");
            $table->string('name', 100)->comment("名称");
            $table->string('path')->comment("图片路径");
            $table->string('redirect')->nullable()->default(null)->comment("跳转地址");
            $table->unsignedInteger('sort')->default(0)->comment("排序");
            $table->enum('status', [0, 1])->default(0)->comment("0 禁用 1 发布");
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
        Schema::dropIfExists('slides');
    }
}
