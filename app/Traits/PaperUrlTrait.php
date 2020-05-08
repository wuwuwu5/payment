<?php

namespace App\Traits;

trait PaperUrlTrait
{
    /**
     * 设置请求数据的路由
     *
     * @param $as
     * @param array $data
     * @return $this
     */
    public function setListUrl($as, $data = [])
    {
        $this->list_url = $this->checkRoute($as, $data);

        return $this;
    }

    /**
     * 设置创建路由
     *
     * @param $as
     * @param array $data
     * @return $this
     */
    public function setCreateUrl($as, $data = [])
    {
        $this->create_url = $this->checkRoute($as, $data);

        return $this;
    }

    /**
     * 设置储存数据的路由
     *
     * @param $as
     * @param array $data
     * @return $this
     */
    public function setStoreUrl($as, $data = [])
    {
        $this->store_url = $this->checkRoute($as, $data);

        return $this;
    }

    /**
     * setEditUrl
     *
     * @param $as
     * @param array $data
     * @return $this
     */
    public function setEditUrl($as, $data = [])
    {
        $this->edit_url = $this->checkRoute($as, $data);

        return $this;
    }

    /**
     * setUpdateUrl
     *
     * @param string $as 别名
     * @param array $data
     * @return $this
     */
    public function setUpdateUrl($as, $data = [])
    {
        $this->update_url = $this->checkRoute($as, $data);

        return $this;
    }

    /**
     * setDestroyUrl
     *
     * @param $as
     * @param array $data
     * @return $this
     */
    public function setDestroyUrl($as, $data = [])
    {
        $this->destroy_url = $this->checkRoute($as, $data);

        return $this;
    }

    /**
     * 获取请求路由 默认指向index方法
     *
     * @param array $data
     * @param bool $new
     * @return string
     */
    private function getListUrl($data = [], $new = false)
    {
        if (empty($this->list_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'index';

            $as = implode('.', $as);

            if ($new) {
                return $this->checkRoute($as, $data);
            }

            $this->setListUrl($as, $data);
        }

        return $this->list_url;
    }


    /**
     * 获取创建路由
     *
     * @param array $data
     * @param bool $new
     * @return string 默认指向create方法
     */
    private function getCreateUrl($data = [], $new = false)
    {
        if (empty($this->create_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'create';

            $as = implode('.', $as);

            if ($new) {
                return $this->checkRoute($as, $data);
            }

            $this->setCreateUrl($as, $data);
        }

        return $this->create_url;
    }

    /**
     * 获取储存路由 默认指向store方法
     *
     * @param array $data
     * @param bool $new
     * @return string
     */
    private function getStoreUrl($data = [], $new = false)
    {
        if (empty($this->store_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'store';

            $as = implode('.', $as);

            if ($new) {
                return $this->checkRoute($as, $data);
            }

            $this->setStoreUrl($as, $data);
        }

        return $this->store_url;
    }

    /**
     * getEditUrl
     *
     * @param array $data
     * @param bool $new
     * @return string
     */
    public function getEditUrl($data = ['@'], $new = false)
    {
        if (empty($this->edit_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'edit';

            $as = implode('.', $as);

            if ($new) {
                return $this->checkRoute($as, $data);
            }

            $this->setEditUrl($as, $data);
        }

        return $this->edit_url;
    }

    /**
     * getUpdateUrl
     *
     * @param array $data
     * @param bool $new
     * @return string
     */
    public function getUpdateUrl($data = ['@'], $new = false)
    {

        if (empty($this->update_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'update';

            $as = implode('.', $as);

            if ($new) {
                return $this->checkRoute($as, $data);
            }

            $this->setUpdateUrl($as, $data);
        }

        return $this->update_url;
    }

    /**
     * getDestroyUrl
     *
     * @param array $data
     * @param bool $new
     * @return string
     */
    public function getDestroyUrl($data = ['@'], $new = false)
    {
        if (empty($this->destroy_url)) {

            $as = $this->parseRouteAs();

            $as[count($as) - 1] = 'destroy';

            $as = implode('.', $as);

            if ($new) {
                return $this->checkRoute($as, $data);
            }

            $this->setDestroyUrl($as, $data);
        }

        return $this->destroy_url;
    }


    /**
     * 获取路由
     *
     * @param $as
     * @param $params
     * @return bool|string
     */
    public function checkRoute($as, $params = [])
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
