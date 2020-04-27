<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Services\FileServices;
use Illuminate\Http\Request;

class FileUploadController extends BaseController
{
    public function store(Request $request)
    {
        $file = FileServices::getApp();
        $fileContents = $request->file('file');
        $result = $file->put('', $fileContents);


        return $this->returnOkApi('上传成功', [
            'src' => '//' . cms_config('alioss')['endpoint'] . '/' . $result,
            'title' => ''
        ]);
    }

    public function token()
    {
        $file = FileServices::getApp();

        $token = $file->signatureConfig();

        return $this->returnOkApi('上传成功', json_decode($token));
    }
}
