<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 16/1/2015
 * Time: 10:19 PM
 */

namespace Common;

class Config
{
    public static $default_controller = 'HelloWorld';
    public static $default_model = 'index';

    public static $error_controller = 'Controller';

    public static $logger_dir = '/temp/logs/';//relative path from app dir
} 