<?php

namespace App\Traits;

trait PaperUrlTrait
{
    /**
     * 设置请求数据的路由
     *
     * @param $as
     * @return \App\Base\Traits\PaperUrlTrait
     */
    public function setListUrl($as)
    {
        $this->list_url = $as;

        return $this;
    }

    /**
     * 设置创建路由
     *
     * @param $as
     * @return $this
     */
    public function setCreateUrl($as)
    {
        $this->create_url = $as;

        return $this;
    }

    /**
     * 设置储存数据的路由
     *
     * @param $as
     * @return $this
     */
    public function setStoreUrl($as)
    {
        $this->store_url = $as;

        return $this;
    }

    /**
     * setEditUrl
     *
     * @param $as
     * @return $this
     */
    public function setEditUrl($as)
    {
        $this->edit_url = $as;

        return $this;
    }

    /**
     * setUpdateUrl
     *
     * @param string $as 别名
     * @return $this
     */
    public function setUpdateUrl($as)
    {
        $this->update_url = $as;

        return $this;
    }

    /**
     * setDestroyUrl
     *
     * @param $as
     * @return $this
     */
    public function setDestroyUrl($as)
    {
        $this->destroy_url = $as;

        return $this;
    }

    /**
     * 获取请求路由 默认指向index方法
     *
     * @param array $data
     * @return string
     */
    private function getListUrl($data = [])
    {
        if (empty($this->list_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'index';

            $as = implode('.', $as);

            $this->setListUrl($as);
        }

        return $this->checkRoute($this->list_url, $data);
    }


    /**
     * 获取创建路由
     *
     * @param array $data
     * @return string 默认指向create方法
     */
    private function getCreateUrl($data = [])
    {
        if (empty($this->create_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'create';

            $as = implode('.', $as);

            $this->setCreateUrl($as);
        }

        return $this->checkRoute($this->create_url, $data);
    }

    /**
     * 获取储存路由 默认指向store方法
     *
     * @param array $data
     * @return string
     */
    private function getStoreUrl($data = [])
    {
        if (empty($this->store_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'store';

            $as = implode('.', $as);

            $this->setStoreUrl($as);
        }

        return $this->checkRoute($this->store_url, $data);
    }

    /**
     * getEditUrl
     *
     * @param array $data
     * @return string
     */
    public function getEditUrl($data = ['@'])
    {
        if (empty($this->edit_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'edit';

            $as = implode('.', $as);

            $this->setEditUrl($as);
        }

        return $this->checkRoute($this->edit_url, $data);
    }

    /**
     * getUpdateUrl
     *
     * @param array $data
     * @return string
     */
    public function getUpdateUrl($data = ['@'])
    {
        if (empty($this->update_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'update';

            $as = implode('.', $as);

            $this->setUpdateUrl($as);
        }

        return $this->checkRoute($this->update_url, $data);
    }

    /**
     * getDestroyUrl
     *
     * @param array $data
     * @return string
     */
    public function getDestroyUrl($data = ['@'])
    {
        if (empty($this->destroy_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'destroy';

            $as = implode('.', $as);

            $this->setDestroyUrl($as);
        }

        return $this->checkRoute($this->destroy_url, $data);
    }


    /**
     * 获取路由
     *
     * @param $as
     * @param $params
     * @return bool|string
     */
    private function checkRoute($as, $params = [])
    {
        try {
            return route($as, $params);
        } catch (\Exception $exception) {
            return '';
        }
    }

    /**
     * 获取路由别名
     *
     * @return mixed
     */
    private function parseRouteAs()
    {
        $as = data_get(\request()->route()->action, 'as', '');

        return explode('.', $as);
    }
}
