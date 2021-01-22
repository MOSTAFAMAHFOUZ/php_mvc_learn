<?php 


namespace app\models;

use app\core\Database;

class Post extends Database
{
    public function getPosts()
    {
        return $this->query("SELECT * FROM posts")->execute()->all();
    }
}