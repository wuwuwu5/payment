<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHashUrlToAddOnArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('add_on_articles', function (Blueprint $table) {
            $table->string('hash_url', 32)->nullable()->comment('标识');
            $table->string('content_hash', 32)->nullable()->comment('内容');
            $table->string('source_url')->nullable()->comment('来源url');
            $table->string('source_name', 20)->nullable()->comment('来源方');
            $table->index('hash_url', 'hash_url');
            $table->index('source_name', 'source_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('add_on_articles', function (Blueprint $table) {
            $table->dropColumn('hash_url');
            $table->dropColumn('content_hash');
            $table->dropColumn('source_url');
            $table->dropColumn('source_name');
            $table->dropIndex('source_name');
            $table->dropIndex('hash_url');
        });
    }
}
