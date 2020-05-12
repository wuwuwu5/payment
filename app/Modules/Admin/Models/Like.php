<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * @var string
     */
    protected $table = 'likes';

    public $timestamps = false;

    /**
     * @var array
     */
    public $sortable = ['*'];

    /**
     * @var array
     */
    protected $fillable = ['model_id', 'model_type', 'user_id'];

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
     * 查询
     *
     * @param $q
     * @param $user_id
     * @param $model_id
     * @param $model_type
     * @return mixed
     */
    public function scopeSearchModel($q, $user_id, $model_id, $model_type)
    {
        return $q->where(compact('user_id', 'model_id', 'model_type'));
    }
}
