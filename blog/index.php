<?php

require_once('src/controllers/add_comment.php');
require_once('src/controllers/selectComment.php');
require_once('src/controllers/changeComment.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');

try{
    if(isset($_GET['action']) && $_GET['action'] !== ''){
        if($_GET['action'] === 'post'){
            if(isset($_GET['id']) && $_GET['id'] > 0){
                $identifier = $_GET['id'];

                post($identifier);
            } else {
                throw new Exception('Aucun identifiant de post n\'a été trouvé');
            }
        } elseif ($_GET['action'] === 'addComment'){
            if(isset($_GET['id']) && $_GET['id'] > 0){
                $identifier = $_GET['id'];

                addComment($identifier, $_POST);
            } else {
                throw new Exception('Aucun identifiant de post n\'a été envoyé');

                die;
            }
        } elseif ($_GET['action'] === 'selectComment'){
            if(isset($_GET['commentId']) && $_GET['id'] > 0 && $_GET['commentId'] > 0){
                $commentIdentifier = $_GET['commentId'];

                selectComment($commentIdentifier);
            } else {
                throw new Exception('Aucun commentaire n\'a été trouvé, désolé !');

                die;
            }
        } elseif ($_GET['action'] === 'changeComment'){
            if(isset($_GET['commentid']) && $_GET['id'] > 0 && $_GET['commentid'] > 0){
                $commentIdentifier = $_GET['commentid'];
                $post = $_GET['id'];

                changeComment($post, $commentIdentifier, $_POST);
            } else {
                throw new Exception('Nous n\'avons pas pu modifier votre commentaire');

                die;
            }
        } else {
            throw new Exception('La page que vous recherchez n\'existe pas');   
        }
    } else {
        homepage();
    }
} catch(Exception $e){
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
