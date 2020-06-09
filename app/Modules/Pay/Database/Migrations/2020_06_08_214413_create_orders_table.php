<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title')->comment('订单标题');
            $table->unsignedBigInteger('class_id')->comment('班型');
            $table->unsignedBigInteger('project_id')->comment('项目');
            $table->unsignedBigInteger('total_fee')->comment('价格 分');
            $table->string('out_trade_no')->comment('订单号');
            $table->unsignedTinyInteger('status')->default(0)->comment('订单状态');
            $table->timestamp('place_order_at')->comment('下单时间');
            $table->timestamp('payment_at')->nullable()->comment('支付时间');
            $table->string('mark')->nullable()->comment('支付说明');
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
        Schema::dropIfExists('orders');
    }
}
