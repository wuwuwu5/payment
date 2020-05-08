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
        'name', 'nickname', 'pid', 'value', 'image', 'category_group_id', 'level', 'path', 'top_id', 'weigh'
    ];

    /**
     * 默认排序
     *
     * @var array
     */
    protected $defaultSortCriteria = ['weigh,desc', 'created_at,desc'];

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

    /**
     * 分组
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id', 'id');
    }

    /**
     * 轮播图
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides()
    {
        return $this->hasMany(Slide::class, 'category_id', 'id');
    }
}
