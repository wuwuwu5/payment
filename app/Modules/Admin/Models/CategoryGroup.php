<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class CategoryGroup extends Model
{
    use PimpableTrait;

    // 目录
    const MENU = 'menu';
    // 前端栏目
    const FRONT_COLUMN = 'front_column';
    // 文章分类
    const ARTICLE = 'article';
    // 轮播图
    const SLIDES = 'slides';
    // 标签
    const TAG = 'tag';

    // 注释
    const NAMES = [
        'menu' => '目录',
        'front_column' => '前端栏目',
        'article' => '文章分类',
        'slides' => '轮播图',
        'tag' => '标签',
    ];

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'title', 'name', 'depth', 'is_show'
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

    /**
     * 子分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
