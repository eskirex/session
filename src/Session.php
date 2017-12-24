<?php

namespace Eskirex\Component\Session;

use Eskirex\Component\Session\Exceptions\SessionRuntimeException;
use Eskirex\Component\Session\Exceptions\InvalidArgumentException;
use Eskirex\Component\Session\Traits\SessionTrait;
use Eskirex\Component\Session\Interfaces\ISession;

class Session implements ISession
{
    use SessionTrait;


    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->init();
    }


    /**
     * @param string $key
     * @param array|string $value
     * @return bool
     */
    public function set($key, $value)
    {
        return $this->doSet([$key => $value]);
    }


    /**
     * @param array $key
     * @return bool
     */
    public function setMultiple($key)
    {
        return $this->doSet($key);
    }


    /**
     * @param string $key
     * @return array|null|string
     */
    public function get($key)
    {
        return $this->doFetch([$key]);
    }


    /**
     * @param array $key
     * @return array|bool|null
     */
    public function getMultiple($key)
    {
        return $this->doFetch($key);
    }


    /**
     * @param string $key
     * @return array|bool|null
     */
    public function has($key)
    {
        return $this->exist([$key]);
    }


    /**
     * @param array $key
     * @return array|bool|null
     */
    public function hasMultiple($key)
    {
        return $this->exist($key);
    }


    /**
     * @param string $key
     * @return bool|null
     */
    public function del($key)
    {
        return $this->doDelete([$key]);
    }


    /**
     * @param array $key
     * @return bool|null
     */
    public function delMultiple($key)
    {
        return $this->doDelete($key);
    }


    /**
     * @return bool
     * @throws SessionRuntimeException
     */
    public function start()
    {
        return $this->doStart();
    }


    /**
     * @return bool|int
     */
    public function status()
    {
        return $this->getStatus();
    }


    /**
     * @return bool
     */
    public function destroy()
    {
        return $this->doDestroy();
    }


    /**
     * @param $sessionId
     * @return bool
     * @throws InvalidArgumentException
     * @throws SessionRuntimeException
     */
    public function setId($sessionId)
    {
        return $this->changeCurrentId($sessionId);
    }


    /**
     * @return bool|null|string
     */
    public function getId()
    {
        return $this->getCurrentId();
    }


    /**
     * @return mixed|string
     */
    public function regenerateId()
    {
        return $this->resetId();
    }


    /**
     * @return bool|void
     */
    public function clear()
    {
        $this->doClear();
    }
}