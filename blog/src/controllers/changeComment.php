<?php
require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Lib\Database\DataBaseConnection as Marie;
use Application\Model\Comment\CommentRepository as John;

function changeComment(string $post, string $commentIdentifier, array $input){
    $author = null;
    $comment = null;
    if(!empty($input['author']) && !empty($input['comment'])){
        $author = $input['author'];
        $comment = $input['comment'];
    } else {
        throw new Exception('Les données du formulaire sont invalides');
    }
    
    $connection = new Marie;

    $commentRepository = new John;
    $commentRepository->connection = $connection;
    $success = $commentRepository->changeComment($commentIdentifier, $author, $comment);
    
    if(!$success){
        throw new Exception('Impossible de modifier le commentaire');
    } else {
        header('Location: index.php?action=post&id='. $post);
    }
}