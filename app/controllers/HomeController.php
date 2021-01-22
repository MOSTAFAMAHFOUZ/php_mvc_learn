<?php 
namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller
{

    public function index()
    {
        $data = ['name'=>"mostafa mahfouz"];
        echo $this->view('home',$data);
    }
}



