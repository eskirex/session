<?php

namespace Eskirex\Component\Session\Traits;

use Eskirex\Component\Dotify\Dotify;
use Eskirex\Component\Session\Exceptions\SessionRuntimeException;
use Eskirex\Component\Session\Exceptions\InvalidArgumentException;

trait SessionTrait
{
    /**
     * Session store
     *
     * @var Dotify
     */
    protected $data = [];


    protected function init()
    {
        if (isset($_SESSION)) {
            $this->data = dotify();
            $this->data->setReferenceArray($_SESSION);
        }
    }


    /**
     * @return bool
     * @throws SessionRuntimeException
     */
    protected function doStart()
    {
        if (session_start() === false) {
            throw new SessionRuntimeException(printf('<b>%s</b>Session start failed', SessionRuntimeException::class));
        }

        $this->data = dotify();
        $this->data->setReferenceArray($_SESSION);

        return true;
    }


    /**
     * Set
     *
     * @param array $arr
     * @return bool
     */
    protected function doSet(Array $arr)
    {
        foreach ($arr as $name => $data) {
            $this->save($name, $data);
        }

        return true;
    }


    /**
     * Fetch
     *
     * @param array $arr
     * @return array|null
     */
    protected function doFetch(Array $arr)
    {
        $return = [];

        foreach ($arr as $name) {
            $return[$name] = $this->fetch($name);
        }

        if (count($return) === 1) {
            return array_values($return)[0];
        }

        if (count($return) > 1) {
            return $return;
        }

        return null;
    }


    /**
     * Delete
     *
     * @param array $arr
     * @return null
     */
    protected function doDelete(Array $arr)
    {
        $return = null;

        foreach ($arr as $name) {
            $return[$name] = $this->delete($name);
        }

        if (count($return) === 1) {
            return array_values($return)[0];
        }

        if (count($return) > 1) {
            return $return;
        }

        return null;
    }


    /**
     * Clear
     *
     * @return bool
     */
    protected function doClear()
    {
        $this->data->clear();

        if (!empty($this->data)) {
            return false;
        }

        return true;
    }


    /**
     * Destroy
     *
     * @return bool
     */
    protected function doDestroy()
    {
        if ($this->getCurrentId()) {
            session_unset();
            session_destroy();
            session_write_close();
            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 4200, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }
        }

        return true;
    }


    /**
     * Get status
     *
     * @return int
     */
    protected function getStatus()
    {
        return session_status();
    }


    /**
     * Set session id
     *
     * @param $newId
     * @return bool
     * @throws InvalidArgumentException
     * @throws SessionRuntimeException
     */
    protected function changeCurrentId($newId)
    {
        if (!preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $newId)) {
            throw new InvalidArgumentException('Invalid Session ID String');
        }

        if (session_id($newId) === false) {
            throw new SessionRuntimeException('session_id Failed');
        }

        return true;
    }


    /**
     * Get current id
     *
     * @return null|string
     */
    protected function getCurrentId()
    {
        return session_id() ?? null;
    }


    /**
     * Re generate id
     *
     * @param bool $return
     * @return string
     */
    protected function resetId($return = false)
    {
        session_regenerate_id(true);

        if ($return) {
            return session_id();
        }
    }


    /**
     * Save process
     *
     * @param $name
     * @param $data
     * @return bool
     */
    protected function save($name, $data)
    {
        return $this->data->set($name, $data);
    }


    /**
     * Exist
     *
     * @param $name
     * @return bool|null
     */
    protected function have($name)
    {
        return $this->data->has($name);
    }


    /**
     * Fetch process
     *
     * @param $name
     * @return mixed
     */
    protected function fetch($name)
    {
        return $this->data->get($name);
    }


    /**
     * Delete process
     *
     * @param $name
     * @return bool|null
     */
    protected function delete($name)
    {
        return $this->data->del($name);
    }


    /**
     * Exist
     *
     * @param array $arr
     * @return array|null
     */
    protected function exist(Array $arr)
    {
        $return = [];

        foreach ($arr as $name) {
            $return[$name] = $this->have($name);
        }

        if (count($return) === 1) {
            return array_values($return)[0];
        }

        if (count($return) > 1) {
            return $return;
        }

        return null;
    }
}
