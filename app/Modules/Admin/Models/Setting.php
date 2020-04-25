<?php

namespace App\Modules\Admin\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Setting extends Model
{
    use PimpableTrait;
    //use Cachable;

    public $table = 'settings';

    public $searchable = ['*'];
    /**
     * @var array
     */
    protected $casts = ['value' => 'array'];

    /**
     * 不可以批量复制字段
     * @var array
     */
    protected $guarded = [];
}
