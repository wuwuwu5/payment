<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jedrzej\Pimpable\PimpableTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use PimpableTrait;
    use HasRoles;

    const SUPER_ADMIN_ID = 1;

    public $primaryKey = 'id';

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
