<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guid', 32)->nullable()->comment('用户id');
            $table->string('username', 32)->nullable()->index('username')->comment('用户名');
            $table->string('nickname', 50)->default('')->comment('昵称');
            $table->string('password')->default('')->comment('密码');
            $table->string('email', 100)->nullable()->index('email')->comment('电子邮箱');
            $table->string('mobile', 11)->nullable()->index('mobile')->comment('手机号');
            $table->string('id_card', 18)->nullable()->index('mobile')->comment('身份证号');
            $table->string('qq', 30)->nullable()->comment('qq');
            $table->string('weixin', 100)->nullable()->comment('微信');
            $table->string('avatar')->default('')->comment('头像');
            $table->boolean('level')->default(0)->comment('等级');
            $table->boolean('gender')->default(0)->comment('性别');
            $table->date('birthday')->nullable()->comment('生日');
            $table->string('bio', 100)->default('')->comment('格言');
            $table->decimal('money', 10)->unsigned()->default(0.00)->comment('余额');
            $table->integer('score')->unsigned()->default(0)->comment('积分');
            $table->integer('login_numbers')->default(0)->comment('登录次数');
            $table->string('session_token')->default('')->comment('登录session_token');
            $table->boolean('locked')->default(1)->comment('是否禁用 0启用 1禁用 ');
            $table->boolean('is_email_verified')->default(false)->comment('邮箱是否为已验证');
            $table->boolean('is_phone_verified')->default(false)->comment('手机号是否为已验证');
            $table->string('registered_ip', 64)->nullable()->comment('注册IP');
            $table->string('registered_way')->default('web')->comment('注册来源:web');
            $table->ipAddress('last_ip')->nullable()->comment('最后一次登录IP');
            $table->boolean('is_admin')->default(0)->comment('是否是超级管理员');

            $table->unique('username');
            $table->unique('email');
            $table->unique('mobile');
            $table->unique('guid');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
