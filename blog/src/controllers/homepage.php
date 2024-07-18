<?php

require_once('src/lib/database.php');
require_once('src/model/post.php');

use Application\Lib\Database\DataBaseConnection as Marie;
use Application\Model\Post\PostRepository as Patrick;

function homepage(){
    $repository = new Patrick();
    $repository->connection = new Marie();
    $posts = $repository->getPosts();

    require('templates/homepage.php');
}


