<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedCategoryGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_groups', function (Blueprint $table) {
            $table->increments('id')->comment('类组');
            $table->string('title')->comment('名称');
            $table->string('name')->comment('编码');
            $table->integer('depth')->default(0)->comment('允许最大层级数');
            $table->string('is_show')->default(1)->comment('是否展示 1 展示 0 不展示');
            $table->timestamps();
            // 索引
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
        Schema::dropIfExists('category_groups');
    }
}
