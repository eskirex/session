<?php

namespace Eskirex\Component\Session\Interfaces;

use Eskirex\Component\Session\Exceptions\SessionRuntimeException;
use Eskirex\Component\Session\Exceptions\InvalidArgumentException;

interface ISession
{
    /**
     * Session constructor.
     */
    public function __construct();


    /**
     * @param string $key
     * @param array|string $value
     * @return bool
     */
    public function set($key, $value);


    /**
     * @param array $key
     * @return bool
     */
    public function setMultiple($key);


    /**
     * @param string $key
     * @return array|null|string
     */
    public function get($key);


    /**
     * @param array $key
     * @return array|bool|null
     */
    public function getMultiple($key);


    /**
     * @param string $key
     * @return array|bool|null
     */
    public function has($key);


    /**
     * @param array $key
     * @return array|bool|null
     */
    public function hasMultiple($key);


    /**
     * @param string $key
     * @return bool|null
     */
    public function del($key);


    /**
     * @param array $key
     * @return bool|null
     */
    public function delMultiple($key);


    /**
     * @return bool
     * @throws SessionRuntimeException
     */
    public function start();


    /**
     * @return bool|int
     */
    public function status();


    /**
     * @return bool
     */
    public function destroy();


    /**
     * @param $sessionId
     * @return bool
     * @throws InvalidArgumentException
     * @throws SessionRuntimeException
     */
    public function setId($sessionId);


    /**
     * @return bool|null|string
     */
    public function getId();


    /**
     * @return mixed|string
     */
    public function regenerateId();


    /**
     * @return bool|void
     */
    public function clear();
}