<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Category extends Model
{
    use PimpableTrait;

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [

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
    public $searchable = [];

    /**
     * 查询字段模式
     *
     *  nickname => '%field%' 模糊查询
     *  created_at= (ge)field
     * @var array
     */
    public $searchableModels = [

    ];

    public $casts = ['value' => 'array'];

    /**
     * 子类
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'pid', 'id');
    }
}
