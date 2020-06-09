<?php

namespace App\Modules\Pay\Models;

use App\Modules\Admin\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class PostUser extends Model
{
    use PimpableTrait;

    public $fillable = [
        'name',
        'phone',
    ];

    /**
     * 可查询字段
     *
     * @var array
     */
    public $searchable = [];

    /**
     * 默认排序
     *
     * @var array
     */
    protected $defaultSortCriteria = ['created_at,desc'];
}
