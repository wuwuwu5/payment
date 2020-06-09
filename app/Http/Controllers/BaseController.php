<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;
use App\Traits\PaperUrlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exceptions\JsonValidatorException;
use App\Exceptions\WebValidatorException;


class BaseController extends Controller
{
    use  ApiTrait, PaperUrlTrait;

    /**
     * @var string 模型
     */
    public $model;

    /**
     * @var string 页面名称
     */
    public $page_name = "";

    /**
     * @var
     */
    private $query;

    /**
     * @var string
     */
    public $view_prefix_path;

    /**
     * 分页
     *
     * @var int
     */
    public $limit = 15;


    /**
     * @var string 用于获取数据的路由
     */
    public $list_url;

    /**
     * @var string 用户创建的路由
     */
    public $create_url;

    /**
     * @var string 用于存储数据的路由
     */
    public $store_url;

    /**
     * @var string 用于修改的路由
     */
    public $edit_url;

    /**
     * @var string 用于更新的路由
     */
    public $update_url;

    /**
     * @var string 用于删除的路由
     */
    public $destroy_url;

    /**
     * BaseController constructor
     * @param array $withs
     * @throws \Exception
     */
    public function __construct()
    {
        if (!empty($this->model)) {
            $this->query = resolve($this->model);
        }
    }

    /**
     * 获取model对象
     *
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * 首页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->indexJson($request);
        }

        return $this->display();
    }


    /**
     * 修改
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $show = $this->getQuery()->findOrFail($id);

        return $this->display(null, compact('show'));
    }


    /**
     * 更新
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws JsonValidatorException
     * @throws WebValidatorException
     */
    public function update($id, Request $request)
    {
        $this->validateData($request);

        $data = $this->getQuery()->findOrFail($id);

        $data->fill($request->all());

        $data->save();

        return $this->returnOkApi();
    }


    /**
     * 删除
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        $data = $this->getQuery()->findOrFail($id);

        $data->delete();

        return $this->returnOkApi();
    }

    /**
     * 创建
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return $this->display();
    }

    /**
     * 添加
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws JsonValidatorException
     * @throws WebValidatorException
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        // 保存创建人
        $request->offsetSet('creator_id', admin_user()->id ?? '');

        $model = $this->getQuery()->fill($request->all());

        $model->save();

        return $this->returnOkApi();
    }

    /**
     * 更新
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws JsonValidatorException
     * @throws WebValidatorException
     */
    public function updatePatch($id, Request $request)
    {
        $this->validateData($request);

        // 数据
        $data = $this->getQuery()->findOrFail($id);

        $data->fill($request->all());

        $data->save();

        return $this->returnOkApi();
    }

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

    /**
     * @param Request $request
     * @return Request
     */
    public function formatIndexQuery(Request $request)
    {
        $searchableModels = $this->getQuery()->searchableModels;

        foreach ($request->all() as $key => $value) {
            $field_model = data_get($searchableModels, $key, '');

            if (!empty($field_model)) {
                $val = str_replace('field', $value, $field_model);

                $request->offsetSet($key, $val);
            }
        }

        return $request;
    }

    /**
     * format json data
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function formatPaginateResponse($data)
    {

        $data = $this->setDataItemUrl($data);

        $json = [
            'code' => 200,
            'msg' => $data->total() > 0 ? '请求数据成功' : '暂无数据',
            'count' => $data->total(),
            'data' => $data->items(),
        ];

        return response()->json($json);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function setDataItemUrl($data)
    {
        $params = \request()->route()->parameters() ?? [];

        foreach ($data as $item) {
            $item->edit_url = $this->getEditUrl(array_merge($params, [$item->id]), true);
            $item->update_url = $this->getUpdateUrl(array_merge($params, [$item->id]), true);
            $item->destory_url = $this->getDestroyUrl(array_merge($params, [$item->id]), true);
        }

        return $data;
    }

    /**
     * 页面返回
     *
     * @param null $view_path
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function display($view_path = null, $data = [])
    {
        $data_path = data_get(debug_backtrace(), '1.function', '');

        if (empty($data)) {
            $method = $data_path . 'Data';

            if (method_exists($this, $method)) {
                $data = $this->{$method}();
            }
        }

        if (empty($view_path)) {
            $view_path = $this->getViewPath();
        }

        // 处理路由数据
        $data = $this->pushUrlToData($data);

        // 追加数据
        $pushDataMethod = 'pushDataTo' . ucfirst($data_path) . 'Data';

        if (method_exists($this, $pushDataMethod)) {
            // 追加其他数据
            $data = $this->{$pushDataMethod}($data);
        }

        return view($view_path, $data);
    }


    /**
     * 处理url数据
     *
     * @param $data
     * @return mixed
     */
    public function pushUrlToData($data)
    {
        $params = \request()->route()->parameters() ?? [];

        $data['list_url'] = $this->getListUrl($params);
        $data['store_url'] = $this->getStoreUrl($params);
        $data['create_url'] = $this->getCreateUrl($params);
        $data['edit_url'] = $this->getEditUrl($params);
        $data['update_url'] = $this->getUpdateUrl($params);
        $data['destroy_url'] = $this->getDestroyUrl($params);
        $data['table_name'] = empty($this->getQuery()) ? '' : $this->getQuery()->getTable();
        $data['page_name'] = $this->page_name;

        return $data;
    }


    /**
     * 获取页面路径
     *
     * @return string
     */
    public function getViewPath()
    {
        // 获取调用此方法的方法名
        $view_name = data_get(debug_backtrace(), '2.function', '');

        // 根据控制器确定目录名称
        $controller = $this->getControllerSub();

        if (empty($controller)) {
            return $view_name;
        }

        return $this->view_prefix_path . $controller . '.' . $view_name;
    }

    /**
     * 获取控制器部分
     *
     * @return string
     */
    private function getControllerSub()
    {
        $controller_namespace = get_class($this);

        $controller_parses = explode('\\', $controller_namespace);

        $controller_name = $controller_parses[(count($controller_parses) - 1)];

        $controller_name = str_replace('Controller', '', $controller_name);

        return Str::singular(Str::snake($controller_name));
    }

    /**
     * 实现方法重载
     *
     * @param string $method
     * @param array $parameters
     * @return mixed|void
     */
    public function __call($method, $parameters)
    {
        try {
            $this->{$method}(...$parameters);
        } catch (\Exception $exception) {
            throw new \BadMethodCallException(sprintf(
                'Method %s::%s does not exist.', static::class, $method
            ));
        }
    }

    /**
     * 验证数据
     *
     * @param Request $request
     * @return |null
     * @throws JsonValidatorException
     * @throws WebValidatorException
     */
    public function validateData(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules($request), $this->ruleMessages(), $this->customAttributes());

        if ($validator->fails()) {

            $message = data_get(collect($validator->getMessageBag()->getMessages())->values()->get('0'), '0', '参数错误');

            if ($request->wantsJson()) {
                throw new JsonValidatorException($message);
            } else {
                throw new WebValidatorException($message, $request->all());
            }
        }

        return null;
    }


    /**
     * 参数验证规则
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        switch ($request->method()) {
            case 'GET':
                return [];
                break;
            case 'POST':
                return [];
                break;
            case 'PUT':
                return [];
                break;
            case 'PATCH':
                return [];
                break;
        }
        return [];
    }

    /**
     * 验证信息
     *
     * @return array
     */
    public function ruleMessages(): array
    {
        return [];
    }

    /**
     * 字段
     *
     * @return array
     */
    public function customAttributes(): array
    {
        return [];
    }
}
