<?php


namespace ishop\base;


use ishop\App;

class View
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $layuot;
    public $data = [];
    public $meta = [];

    public function __construct($route, $layout='', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if($layout === false){
            $this->layuot = false;
        }else{
            $this->layuot = $layout ?: LAYOUT;
        }
    }

    public function render($meta, $data){

        if(is_array($data)) extract($data);

        $prefix = str_replace('\\', '/', $this->prefix);

        $viewFile = APP . "/views/" . $prefix . $this->controller . '/' . $this->view . '.php';

        if(file_exists($viewFile)){
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }else{
            throw new \Exception("Шаблон вид {$viewFile}", 500);
        }

        if(false !== $this->layuot){

            $layoutFile = APP . '/views/layouts/' . $this->layuot . '.php';
            if(file_exists($layoutFile)){
                require_once $layoutFile;
            }else {
                throw new \Exception("Не найден шаблон {$layoutFile}", 500);
            }
        }


    }

}