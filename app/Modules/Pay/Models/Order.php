<?php

namespace App\Modules\Pay\Models;

use App\Modules\Admin\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Order extends Model
{
    use PimpableTrait;

    public $fillable = [
        'user_id',
        'title',
        'class_id',
        'project_id',
        'total_fee',
        'out_trade_no',
        'status',
        'place_order_at',
        'payment_at',
        'mark',
        'phone'
    ];

    /**
     * 可查询字段
     *
     * @var array
     */
    public $searchable = ['status'];

    /**
     * 默认排序
     *
     * @var array
     */
    protected $defaultSortCriteria = ['created_at,desc'];

    /**
     * @var array
     */
    public $dates = ['place_order_at' => 'Y-m-d H:i:s', 'payment_at' => 'Y-m-d H:i:s'];

    public function classInfo()
    {
        return $this->belongsTo(Category::class, 'class_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(WeChatUser::class, 'user_id', 'id');
    }

    public function projectInfo()
    {
        return $this->belongsTo(Category::class, 'project_id', 'id');
    }
}
