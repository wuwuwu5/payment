<?php

namespace App\Modules\Admin\Services;

use Illuminate\Support\Facades\Storage;
use Iidestiny\Flysystem\Oss\OssAdapter;
use Iidestiny\Flysystem\Oss\Plugins\FileUrl;
use Iidestiny\Flysystem\Oss\Plugins\SignUrl;
use Iidestiny\Flysystem\Oss\Plugins\TemporaryUrl;
use Iidestiny\Flysystem\Oss\Plugins\SignatureConfig;
use Iidestiny\Flysystem\Oss\Plugins\SetBucket;
use League\Flysystem\Filesystem;

/**
 * 文件服务类
 *
 * Class FileServices
 * @package App\Services
 */
class FileServices
{
    public static $app;

    public static function getApp()
    {
        app('filesystem')->extend('oss', function ($app, $config) {

            $config = cms_config('alioss');

            $root = $config['root'] ?? null;
            $buckets = isset($config['buckets']) ? $config['buckets'] : [];
            $adapter = new OssAdapter(
                $config['access_key'] ?? '',
                $config['secret_key'] ?? '',
                $config['endpoint'],
                $config['bucket'] ?? '',
                $config['isCName'] ?? '',
                $root,
                $buckets
            );

            $filesystem = new Filesystem($adapter);

            $filesystem->addPlugin(new FileUrl());
            $filesystem->addPlugin(new SignUrl());
            $filesystem->addPlugin(new TemporaryUrl());
            $filesystem->addPlugin(new SignatureConfig());
            $filesystem->addPlugin(new SetBucket());

            return $filesystem;
        });

        self::$app = Storage::disk('oss');

        return self::$app;
    }
}
