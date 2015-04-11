<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 5/1/2015
 * Time: 10:25 PM
 */
namespace Controller;

class HelloWorld extends \Core\Controller
{
    public function __construct()
    {
        //we must do it, because it won't created implicitly
        parent::__construct();
        $msg = "Hello WOrld!";
    }

    public function index()
    {
        $this->view->title = "hello world";
        $this->view->msg = "this is my message to the world";
        $this->view->Render('index.html');
    }
} 