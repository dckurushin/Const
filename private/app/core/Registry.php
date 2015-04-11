<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 5/1/2015
 * Time: 1:22 AM
 */

namespace Core;


class Registry {
    private $data = array();
    /**
     * Singleton pattern implementation
     * @return mixed
     */
    public static function Instance()
    {
        static $selfInstance = null;
        if ($selfInstance == null)
            $selfInstance = new self();
        return $selfInstance;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        //todo record error
        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }
    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**  As of PHP 5.1.0  */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**  As of PHP 5.1.0  */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    private function __construct() {
        //the php super globals
        $this->data['get'] = &$_GET;
        $this->data['post'] = &$_POST;
        $this->data['server'] = &$_SERVER;
        $this->data['cookie'] = &$_COOKIE;
        $this->data['env'] = &$_ENV;
        $this->data['files'] = &$_FILES;
        $this->data['session'] = &$_SESSION;
        $this->data['request'] = &$_REQUEST;
    }

    private function __clone() {/*not allowed*/}
} 