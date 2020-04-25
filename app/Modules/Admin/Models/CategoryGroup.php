<?php

namespace App\Modules\Admin\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class CategoryGroup extends Model
{
    use PimpableTrait;
//    use Cachable;
    /**
     * @var string 分类群组
     */
    protected $table = 'category_groups';

    /**
     * @var array
     */
    public $sortable = ['name', 'title'];

    /**
     * @var array
     */
    public $searchable = ['name', 'title'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'title'];

    /**
     * 分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

}
