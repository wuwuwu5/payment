<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Slide extends Model
{
    use PimpableTrait;

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'category_id', 'name', 'path', 'redirect', 'sort', 'status'
    ];

    /**
     * 默认排序
     *
     * @var array
     */
    protected $defaultSortCriteria = ['sort,desc', 'created_at,desc'];

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
     * 分组
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
