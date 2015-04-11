<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 6/1/2015
 * Time: 8:04 PM
 */

namespace Core;

class View {
    private $data = array();
    private $viewPath;

    public function __construct()
    {
    }

    /**
     * @param $_view_path_ view path, variable is in bad convention by design - to prevent name conflicts
     */
    public function Render($_view_path_)
    {
        $this->viewPath = APP_PATH . DS . 'views' . DS . $_view_path_;
        if (!\Common\FileSystem::IsFileExists($this->viewPath))
        {
            return;//todo
        }
        extract($this->data);
        require($this->viewPath);
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
} 