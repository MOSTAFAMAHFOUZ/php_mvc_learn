<?php 
namespace app\core;

abstract class BaseContoller 
{
    protected $model;
    protected $view;
    protected $view_file;


    /**
     * 
     * inistaniate new model 
     * 
     */

    public function model(string $model)
    {
        require_once "../models/".$model.".php";
        $dbModel = '\app\models\\'.$model;

        return new $dbModel();
    }


    public function view(string $view,array $params = [])
    {
        $this->view_file = "../app/views/".$view.'.php';
        // check if file is exists 
        if(file_exists($this->view_file))
        {
            $main_content = $this->baseLayout();
            $view_content = $this->viewLayout($view,$params);
            return str_replace('{{content}}',$view_content,$main_content);
        }
        else 
        {
            die("this file {$view} not exist");
            exit();
        }
    }


    protected function baseLayout()
    {
        ob_start();
        require_once('../app/views/main.php');
        return ob_get_clean();
    }


    protected function viewLayout($view,$params)
    {
        ob_start();
        require_once("../app/views/{$view}.php");
        return ob_get_clean();
    }

}