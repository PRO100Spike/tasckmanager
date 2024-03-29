<?php

class Session {
    function __construct () {
        session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
    }

    public static function destroy() {
        unset($_SESSION);
        session_destroy();
    }

    public static function isGuest() {
        return !isset($_SESSION['user']);
    }
}