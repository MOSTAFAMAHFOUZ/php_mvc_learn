<?php 

namespace app\controllers;
use app\core\Controller;
use app\models\Post;

class PostController extends Controller 
{
    protected $conn;


    public function __construct()
    {
        $this->db = new Post;
    }
    public function index()
    {
        $data = $this->db->getPosts();
        echo $this->view('posts/index',["data"=>$data]);
    }
}