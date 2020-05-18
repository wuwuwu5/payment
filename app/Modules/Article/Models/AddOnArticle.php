<?php

namespace App\Modules\Article\Models;

use App\Modules\Article\Scopes\ArticleScopeTrait;
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
        'body', 'hash_url', 'content_hash', 'source_url', 'source_name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
