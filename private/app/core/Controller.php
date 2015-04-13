<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 5/1/2015
 * Time: 10:24 PM
 */

namespace Core;

class Controller {
    protected $view;
    //global registry reference
    protected $registry;
    public function __construct()
    {
        $registry = &$_GLOBALS['registry'];
        $this->view = new View();
    }

    public function error404()
    {
        header('HTTP/1.0 404 Not Found');//change status from 200(success) into 404
        $this->view->render('errors/404.html');
    }
} 