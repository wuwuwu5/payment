<?php

namespace App\Modules\Pay\Models;

use Illuminate\Database\Eloquent\Model;

class WeChatUser extends Model
{
    public $table = 'wechat_users';

    public $fillable = [
        'nickname',
        'avatar',
        'openid',
        'unionid',
    ];
}
