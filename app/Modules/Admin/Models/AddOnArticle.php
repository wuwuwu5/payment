<?php

namespace App\Modules\Admin\Models;

use App\Modules\Admin\Scopes\ArticleScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;

class AddOnArticle extends Model
{
    use SoftDeletes;

    /**
     * 可填充字段
     *
     * @var array
     */
    protected $fillable = [
        'body',
    ];
}
