<?php
require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Lib\Database\DataBaseConnection as Marie;
use Application\Model\Comment\CommentRepository as John;

function selectComment(string $commentIdentifier){
    $connection = new Marie();

    $commentRepository = new John();
    $commentRepository->connection = $connection;
    $selectedComment = $commentRepository->selectComment($commentIdentifier);
    
    require('templates/changeComment.php');
}