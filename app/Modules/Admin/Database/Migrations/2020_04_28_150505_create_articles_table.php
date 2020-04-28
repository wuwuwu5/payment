<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('column_id')->default(0)->comment('一级栏目ID 对应 category 主键');
            $table->unsignedBigInteger('column2_id')->default(0)->comment('二级栏目ID  对应 category 主键');
            $table->unsignedTinyInteger('is_published')->default(0)->comment('0 不发布 1 发布');
            $table->unsignedTinyInteger('is_commend')->default(0)->comment('0 不推荐 1推荐');
            $table->unsignedBigInteger('creator_id')->comment("创建人ID");
            $table->unsignedBigInteger('category_id')->comment("分类ID");
            $table->string('title')->comment("文章标题");
            $table->string('short_title')->comment("简略标题");
            $table->json('keywords')->comment("关键字");
            $table->string('cover')->comment("封面");
            $table->string('lit_pic')->nullable()->comment("缩略图");
            $table->string('source')->default("")->comment("文章来源");
            $table->unsignedInteger('view_count')->default(0)->comment("查看数");
            $table->unsignedInteger('give_count')->default(0)->comment("点赞数");
            $table->unsignedInteger('collection_count')->default(0)->comment("收藏数");
            $table->unsignedInteger('post_count')->default(0)->comment("评论数");
            $table->unsignedInteger('not_post')->default(1)->comment("0 不允许评论 1 允许评论");
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->timestamp('published_at')->default(null)->comment('发布时间');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['creator_id', 'category_id']);
            $table->index(['category_id', 'is_published', 'is_commend']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
