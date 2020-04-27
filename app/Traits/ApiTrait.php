<?php

namespace App\Traits;

trait ApiTrait
{
    public $apiToArray = 0;//API将API转换成数组输出

    /**
     * @param $code
     * @param $msg
     * @param array $data
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function returnApi($code, $msg, $data = [])
    {
        $json_data = [
            'code' => $code,//业务代码
            'msg' => $msg,
            'data' => $data
        ];
        if ($this->apiToArray == 1) {
            return $json_data;
        }

        return response()->json($json_data);
    }

    /**
     * @param string $msg
     * @param array $data
     * @param int $code
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function returnOkApi($msg = '操作成功', $data = null, $code = 200)
    {
        return $this->returnApi($code, $msg, $data);
    }

    /**
     * @param string $msg
     * @param array $data
     * @param int $code
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function returnErrorApi($msg = '操作失败', $data = [], $code = 1)
    {
        return $this->returnApi($code, $msg, $data);
    }
}
