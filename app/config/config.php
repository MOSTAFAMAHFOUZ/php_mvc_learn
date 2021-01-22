<?php 


return [
    "url" => "__BASE_URL__",
    'app_root' => dirname(dirname(__FILE__)),
    'base_root' => dirname(dirname(dirname(__FILE__))),
    'public_path' => dirname(dirname(dirname(__FILE__)))."/public/", 
    'assets' => "__BASE_URL__", 
    'site_name' => "__NAME_OF_YOUR_PROJECT__", 

    // database data 
    "DB_HOST" => "localhost",
    "DB_USER" => "root",
    "DB_PASS" => "",
    "DB_NAME" => "__DATABASE_NAME__",
];