<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHasTag extends Model
{
    /**
     * @var string 标签所有者
     */
    protected $table = 'model_has_tags';

    public $timestamps= false;

    /**
     * @var array
     */
    public $sortable = ['*'];

    /**
     * @var array
     */
    protected $fillable = ['model_id', 'model_type', 'tag_id'];

    /**
     * 所有者
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * 标签
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Category::class, 'tag_id', 'id');
    }
}
