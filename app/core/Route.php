<?php 

namespace app\core;



class Route 
{
    protected $url;
    protected $currentController = "HomeController";
    protected $currentMethod = "index";
    protected $params = [];
    protected $check=false;


    public function __construct()
    {
        $this->url = $this->getUrl();
        if(isset($this->url[0])){
            $this->getController($this->url[0]);
            unset($this->url[0]);
            // check from method
            if(isset($this->url[1])){

                $controller = $this->initController($this->currentController);
                $this->currentController = new $controller;
                $this->getMethod($this->url[1]);
                unset($this->url[1]);
            }else {
                $this->check = true;
            }
        }else {
            $this->check = true;
        }



        if(!$this->check)
        {
            $this->params = $this->url ? array_values($this->url) : [];
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);

        }else {
            $this->runDefault();
        }

    }

    protected function getUrl()
    {
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }
    }


    // get controller class
    protected function getController(string $controller)
    {
        
        if(file_exists('../app/controllers/'.ucwords($controller).'Controller.php'))
        {
            $this->currentController =  ucwords($controller).'Controller';
        }
        else 
        {
            return "false response";
            exit;
        }
        // return $this->currentController;
    }



    

    // get method from the controller 
    protected function getMethod(string $method)
    {
        if(method_exists($this->currentController,$method))
        {
            $this->currentMethod = $method; 
        }
        else 
        {
            echo "Method {$method} is not exist - response class";
            die();
            exit();
        }
    }




    protected function initController($controller)
    {
        require_once '../app/controllers/'.$controller.'.php';
        return '\app\controllers\\'.$controller;
    }

    protected function runDefault()
    {
        $this->currentController = "HomeController";
        require_once '../app/controllers/'.$this->currentController.'.php';
        $controller = '\app\controllers\\'.$this->currentController;
        $controller = $this->initController($this->currentController);
        $this->currentController = new $controller;
        call_user_func_array([$this->currentController,$this->currentMethod],$this->params);

    }





}