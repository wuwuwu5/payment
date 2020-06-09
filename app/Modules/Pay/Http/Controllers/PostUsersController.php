<?php

namespace App\Modules\Pay\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PostUsersController extends BaseController
{
    public $model = \App\Modules\Pay\Models\PostUser::class;

    public $view_prefix_path = "pay::admin.";

    public $page_name = '用户';

    /**
     * 首页JSON
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexJson(Request $request)
    {
        $request = $this->formatIndexQuery($request);

        $data = $this
            ->getQuery()
            ->pimp()
            ->paginate($request->input('limit', $this->limit ?? 15));

        return $this->formatPaginateResponse($data);
    }
}
