<?php
require_once('src/lib/database.php'); 
require_once('src/model/post.php');
require_once('src/model/comment.php');

use Application\Lib\Database\DataBaseConnection as Marie;
use Application\Model\Post\PostRepository as Patrick;
use Application\Model\Comment\CommentRepository as John;

function post(string $identifier){
	$connection = new Marie();

    $postRepository = new Patrick();
    $postRepository->connection = $connection;
    $post = $postRepository->getPost($identifier);

    $commentRepository = new John();
    $commentRepository->connection = $connection;
    $comments = $commentRepository->getComments($identifier);

	require('templates/post.php');
}