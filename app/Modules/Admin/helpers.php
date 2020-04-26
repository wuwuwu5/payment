<?php


use App\Modules\Admin\Models\Setting;

if (!function_exists('array_get')) {
    /**
     * @param $data
     * @param $key
     * @param string $default
     * @return string
     */
    function array_get($data, $key, $default = '')
    {
        return Arr::get($data, $key, $default);
    }
}

if (!function_exists('cms_config')) {
    function cms_config($key, $default = '')
    {
        if (is_null($key)) {
            return $default;
        }
        $settings = Setting::where(['name' => $key])->first();
        return $settings->value ?? null;
    }
}

if (!function_exists('admin_asset')) {
    /**
     * 资源加载 res
     * @param $path
     * @return string
     */
    function admin_asset($path)
    {
        if (!empty($path) && $path[0] == '/') {
            $path = substr($path, 1);
        }

        return asset('/static/admin/' . $path);
    }
}


if (!function_exists('user')) {

    function user($field = '')
    {
        try {
            $info = \Illuminate\Support\Facades\Auth::guard('web')->user();
            return $field ? $info[$field] : $info;
        } catch (Exception $exception) {
            return false;
        }
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return \App\Modules\Admin\Models\User::where('id', 1)->first();

    }
}


if (!function_exists('str_contains')) {
    /**
     * Determine if a given string contains a given substring.
     *
     * @param string $haystack
     * @param string|array $needles
     * @return bool
     */
    function str_contains($haystack, $needles)
    {
        return Str::contains($haystack, $needles);
    }
}

if (!function_exists('str_random')) {
    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param int $length
     * @return string
     *
     * @throws \RuntimeException
     */
    function str_random($length = 16)
    {
        return Str::random($length);
    }
}

if (!function_exists('str_after')) {
    /**
     * Return the remainder of a string after a given value.
     *
     * @param string $subject
     * @param string $search
     * @return string
     */
    function str_after($subject, $search)
    {
        return Str::after($subject, $search);
    }
}


if (!function_exists('admin_url')) {
    /**
     * 链接设置，可以是控制器，也可以路径
     * @param $path
     * @param $method
     * @param $option
     */
    function admin_url($path, $method = 'index', $option = [])
    {

        $controller = ucwords($path) . 'Controller@' . lcfirst(ucwords($method));
        $url = action($controller, $option);

        try {
            $url = action($controller, $option);
        } catch (Exception $e) {
            return '<br/>提示:' . $controller . ' 这个路由没用定义<br/>';
        }
        return $url;
    }
}
if (!function_exists('admin_route')) {
    /**
     * 链接设置，可以是控制器，也可以路径
     * @param $path
     * @param $method
     * @param $option
     */
    function admin_route($path = 'index', $method = 'list', $option = [])
    {

        $rout_name = str_replace($path, $method, request()->route()->getName());

        try {
            $url = route($rout_name, $option);
        } catch (Exception $e) {
            return '<br/>提示:' . $rout_name . ' 这个路由没用定义<br/>';
        }
        return $url;
    }
}

if (!function_exists('camel_case')) {
    /**
     * Convert a value to camel case.
     *
     * @param string $value
     * @return string
     */
    function camel_case($value)
    {
        return Str::camel($value);
    }
}

if (!function_exists('tree')) {
    /**
     * 处理权限分类
     */
    function tree($list = [], $pk = 'id', $pid = 'parent_id', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = [];
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = [];
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            //转出ID对内容
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];

                } else {

                    if (isset($refer[$parentId])) {

                        $parent =& $refer[$parentId];

                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
}


if (!function_exists('category')) {
    /**
     * 后台菜单
     */
    function category($group): array
    {
        $categoryGroup = \App\Modules\Admin\Models\CategoryGroup::where('name', $group)->first();

        $categories = $categoryGroup
            ->categories()
            ->where('status', 1)
            ->orderBy('weigh', 'desc')->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        $categories = tree($categories->toArray(), 'id', 'pid', 'sub_menus');
        return $categories;
    }
}


if (!function_exists('show_hide_menu_auth')) {

    function show_hide_menu_auth($route_name)
    {
        $admin = admin();
        if ($admin['is_admin']) {
            return true;
        }
        try {
            if ($admin->hasPermissionTo($route_name, 'web')) {
                return true;
            }
        } catch (\Exception $exception) {
            return false;
        }

        return false;

    }
}
// 渲染封面图片
if (!function_exists('render_cover')) {

    function render_cover($value = '', $type = 'img')
    {
        // 如果key中存在http或者https 直接返回
        if (strpos($value, 'http://') !== false
            || strpos($value, 'https://') !== false
            || strpos($value, 'data:image') !== false
        ) {
            return $value;
        }

        // 如果资源存在
        if ($value) {

            // 获取配置
            $diskConfig = cms_config('alioss');

            // 如果是七牛
            return http_format($diskConfig['endpoint']) . '/' . $value;
        }
        // 返回系统默认
        return asset('/imgs/' . $type . '.png');
    }
}

// http格式化
if (!function_exists('http_format')) {

    function http_format($value)
    {

        if (str_contains($value, 'http')) {
            return $value;
        } else {
            return '//' . $value;
        }
    }
}
if (!function_exists('is_admin')) {

    function is_admin()
    {
        $admin = auth()->user();

        if ($admin['is_admin'] == 1) {
            return true;
        }

        // 超级管理员
        if ($admin->hasRole(['super_admin'])) {
            return true;
        }

        return false;
    }
}

if (!function_exists('category_path')) {

    function category_path($id, $array)
    {
        $category = \App\Modules\Admin\Models\Category::query()->where(compact('id'))->select('id', 'pid')->first();

        $array[] = $category->id;

        if (empty($category->pid)) {
            return $array;
        }

        return category_path($category->pid, $array);
    }
}

if (!function_exists('userHasMenu')) {

    function userHasMenu($user, $role)
    {
        if ($user->is_admin == 1) {
            return true;
        }

        // 超级管理员
        if ($user->hasRole(['super_admin'])) {
            return true;
        }

        // 普通管理员(权限和权限路由不可见)
        if ($user->hasRole(['admin'])) {

            // 权限和路由管理
            if (in_array($role, ['role', 'permission'])) {

                if ($user->hasRole($role) || $user->can($role)) {
                    return true;
                }

                return false;
            }

            return true;
        }

        return $user->hasRole($role) || $user->can($role);
    }
}


if (!function_exists('number2chinese')) {
    function number2chinese($num)
    {
        if (is_int($num) && $num < 100) {
            $char = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九');
            $unit = ['', '十', '百', '千', '万'];
            $return = '';
            if ($num < 10) {
                $return = $char[$num];
            } elseif ($num % 10 == 0) {
                $firstNum = substr($num, 0, 1);
                if ($num != 10) $return .= $char[$firstNum];
                $return .= $unit[strlen($num) - 1];
            } elseif ($num < 20) {
                $return = $unit[substr($num, 0, -1)] . $char[substr($num, -1)];
            } else {
                $numData = str_split($num);
                $numLength = count($numData) - 1;
                foreach ($numData as $k => $v) {
                    if ($k == $numLength) continue;
                    $return .= $char[$v];
                    if ($v != 0) $return .= $unit[$numLength - $k];
                }
                $return .= $char[substr($num, -1)];
            }
            return $return;
        }
    }
}

if (!function_exists('userHasGroupset')) {

    function userHasGroupset($user)
    {
        $groupSet = $user->groupSet;

        if (empty($groupSet)) {
            return [];
        }

        $group = $groupSet->group()->select('id as value', 'nickname as name')->first()->toArray();

        return [$group];
    }
}

if (!function_exists('userHasPermissionGroupset')) {

    function userHasPermissionGroupset($user)
    {
        $groups = $user->permissionGroups()->with('group:id,nickname')->get();

        if ($groups->isEmpty()) {
            return [];
        }

        $array = [];

        foreach ($groups as $group) {
            $array[] = ['name' => data_get($group->group, 'nickname'), 'value' => data_get($group->group, 'id'),];
        }

        return $array;
    }
}


if (!function_exists('slide_list')) {
    /**
     * 通过轮播图类型获取非禁用的轮播图组
     *
     * @param string $type 轮播图类型/位置
     * @return array
     */
    function slide_list($type)
    {
        $slide = \App\Modules\Admin\Models\Slide::where('type', $type)->where('locked', 0)->first();
        if (empty($slide)) return [];
        $value = $slide->value;
        if (empty($value)) return [];
        foreach ($value as $k => $v) if ($v['is_show'] == 0) unset($value[$k]);
        array_multisort(array_column($value, 'seq'), SORT_ASC, $value);
        return $value;
    }
}

if (!function_exists('is_mobile')) {
    /**
     * 通过轮播图类型获取非禁用的轮播图组
     *
     * @return boolean
     */
    function is_mobile()
    {
        $agent = new Jenssegers\Agent\Agent();
        return $agent->isMobile();
    }
}


if (!function_exists('toBlade')) {
    /**
     * 路径/ 转换为.
     *
     * @param $path
     * @return string
     */
    function toBlade($path)
    {
        return strtolower(implode(".", explode("\\", $path)));
    }
}


if (!function_exists('linux_path')) {
    /**
     * 转换成linux路径
     * @param $path
     * @return mixed
     */
    function linux_path($path)
    {
        return str_replace("\\", "/", $path);
    }
}

if (!function_exists('nroute')) {
    /**
     * 转换成linux路径
     * @param $path
     * @return mixed
     */
    function nroute($name, $para = [])
    {
        try {
            return route($name, $para);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}
