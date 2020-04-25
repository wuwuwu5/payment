<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class User extends Model
{
    use PimpableTrait;

    /**
     * string 默认密码
     */
    const DEFAULT_PASSWORD = '123456';

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'username', 'email', 'mobile', 'id_card', 'password', 'locked'
    ];

    /**
     * 默认排序
     *
     * @var array
     */
    protected $defaultSortCriteria = ['created_at,desc'];

    /**
     * 可查询字段
     *
     * @var array
     */
    public $searchable = ['nickname', 'username'];


    /**
     * 查询字段模式
     *
     * @var array
     */
    public $searchableModels = [
        'nickname' => '%field%',
        'username' => '%field%',
    ];

    /**
     * 设置密码
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        return bcrypt($value);
    }
}
