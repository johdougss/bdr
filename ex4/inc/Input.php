<?php

class Input
{
    protected static $params;

    private static function init()
    {
        parse_str(file_get_contents("php://input"), self::$params);
        self::$params = array_merge(self::$params, $_GET);
    }

    public static function all()
    {
        if (self::$params == null)
            self::init();
        return self::$params;
    }

    public static function get($key, $default = null)
    {
        if (self::$params == null)
            self::init();

//        return (isset($_REQUEST[$key])) ? $_REQUEST[$key] : $default;
        return (isset(self::$params[$key])) ? self::$params[$key] : $default;
    }
}

