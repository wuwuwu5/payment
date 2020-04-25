<?php

namespace App\Modules\Admin\Models;


use App\Modules\Admin\Scopes\CreatorIdScope;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;

class Category extends Model
{
    use SoftDeletes;
    use PimpableTrait;
    //use Cachable;
    const GROUP = 7;

    /**
     * @var string 分类
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    public $searchable = ['name', 'pid', 'parent:name', 'category_group_id'];

    /**
     * @var array
     */
    public $sortable = ['weigh', 'pid'];

//    protected $defaultSortCriteria = ['weigh,desc'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'weigh', 'image', 'category_group_id', 'value', 'nickname', 'pid', 'top_id', 'path', 'creator_id'];

    /**
     * @var array
     */
    public static $baseFields = ['id', 'name', 'pid'];


    /**
     * @var array
     */
    protected $casts = ['value' => 'array'];


    /**
     * 所属群组
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id', 'id');
    }

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
     * 子类
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'pid', 'id');
    }
}
