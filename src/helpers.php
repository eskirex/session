<?php

use Eskirex\Component\Session\Session;

if (!function_exists('session')) {
    /**
     * Dotify constructor helper
     *
     * @param array|string|Session $array
     * @return Session
     */
    function session()
    : Session
    {
        return new Session();
    }
}
