<?php

namespace App\Modules\Admin\Models;

use App\Modules\Admin\Scopes\ArticleScopeTrait;
use ElfSundae\Laravel\Hashid\Facades\Hashid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;

class Article extends Model
{
    use PimpableTrait;
    use SoftDeletes;
    use ArticleScopeTrait;

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'column_id', 'column2_id', 'category_id', 'title', 'short_title', 'keywords', 'cover', 'not_post', 'published_at', 'creator_id', 'lit_pic', 'is_published', 'is_commend'
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
    public $searchable = [
        'title', 'is_published', 'is_commend'
    ];

    /**
     * 查询字段模式
     *
     *  nickname => '%field%' 模糊查询
     *  created_at= (ge)field
     * @var array
     */
    public $searchableModels = [
        'title' => '%field%'
    ];

    /**
     * @var array
     */
    public $dates = ['published_at'];

    /**
     * @var array
     */
    public $casts = [
        'keywords' => 'array',
        'is_published' => 'bool',
        'is_commend' => 'bool',
    ];

    protected $appends = ['hash_id'];

    /**
     * 附属信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function add()
    {
        return $this->hasOne(AddOnArticle::class, 'article_id', 'id');
    }

    /**
     * 获取文章图片
     */
    public function tags()
    {
        return $this->morphMany(ModelHasTag::class, 'model');
    }

    /**
     * 分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 创建人
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
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
