<?php

namespace App\Modules\Admin\Models;

use ElfSundae\Laravel\Hashid\Facades\Hashid;
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

    protected $appends = ['hash_id'];

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
        return $this->hasMany(Slide::class);
    }

    /**
     * 文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * 栏目文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function columnArticles()
    {
        return $this->hasMany(Article::class, 'column_id', 'id');
    }

    /**
     * 副栏目文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function column2Articles()
    {
        return $this->hasMany(Article::class, 'column2_id', 'id');
    }

    /**
     * 标签使用
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(ModelHasTag::class, 'tag_id', 'id');
    }

    /**
     * hash
     *
     * @return mixed
     */
    public function getHashIdAttribute()
    {
        return Hashid::encode($this->attributes['id']);
    }
}
