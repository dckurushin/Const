<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 16/1/2015
 * Time: 9:27 PM
 */
namespace Common;

class FileSystem
{
    public static function IsFileExists($path)//example
    {
        return is_file($path);
    }
}