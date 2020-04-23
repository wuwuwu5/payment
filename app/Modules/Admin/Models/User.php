<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class User extends Model
{
    use PimpableTrait;

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
    public $searchable = [];


    /**
     * 查询字段模式
     *
     * @var array
     */
    public $searchableModels = [
        'nickname' => '%field%'
    ];


}
