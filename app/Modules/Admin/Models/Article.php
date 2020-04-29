<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;

class Article extends Model
{
    use PimpableTrait;
    use SoftDeletes;

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'column_id', 'column2_id', 'category_id', 'title', 'short_title', 'keywords', 'cover', 'not_post', 'published_at', 'creator_id', 'lit_pic'
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

    public $casts = [
        'keywords' => 'array'
    ];

    /**
     * 获取文章图片
     */
    public function tags()
    {
        return $this->morphMany(ModelHasTag::class, 'model');
    }
}
