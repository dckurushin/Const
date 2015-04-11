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
        $this->view->render('errors/404.html');
    }
} 