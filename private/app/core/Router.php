<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 5/1/2015
 * Time: 12:56 AM
 */

namespace Core;


class Router {
    private $path = null;
    private $controller = null;
    private $model = null;

    public function __construct($path)
    {
        $m_path = $path;
        $pattern = '~^(.*?)(/(.*))?$~';
        preg_match($pattern, $m_path, $matches);
        $this->controller = isset($matches[1]) ? $matches[1] : null;
        $this->model = isset($matches[3]) ? $matches[3] : null;
    }

    public function GetController()
    {
        return $this->controller;
    }

    public function GetModel()
    {
        return $this->model;
    }
} 