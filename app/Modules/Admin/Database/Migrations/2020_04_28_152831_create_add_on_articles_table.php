<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddOnArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_on_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->comment("文章ID");
            $table->text('body')->comment('文章内容');
            $table->timestamps();
            $table->softDeletes();
            $table->index('article_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_on_articles');
    }
}
