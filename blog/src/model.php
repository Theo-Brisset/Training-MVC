<?php

function getPosts() {
	// We connect to the database.
	$database = dbConnect();

	// We retrieve the 5 last blog posts.
	$statement = $database->query(
    	"SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
	);
	$posts = [];
	while (($row = $statement->fetch())) {
    	$post = [
        	'title' => $row['title'],
        	'french_creation_date' => $row['french_creation_date'],
        	'content' => $row['content'],
            'identifier' => $row['id'],
    	];

    	$posts[] = $post;
	}

	return $posts;
}


function getPost($identifier){
    $database = dbConnect();
    $statement = $database->prepare(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
    );

    $statement->execute([$identifier]);

    $row = $statement->fetch();
    $post = [
        'title' => $row['title'],
        'french_creation_date' => $row['french_creation_date'],
        'content' => $row['content'],
        'identifier' => $row['id'],
    ];
    
    return $post;
}

class Comment {
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
}

function getComments(string $post) : array{
    $database = dbConnect();
    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );

    $statement->execute([$post]);

    $comments = [];
    while($row = $statement->fetch()) {
        $comment = new Comment();
        $comment->author = $row['author'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->comment = $row['comment'];
        $comments[] = $comment;
    }

    return $comments;
}

function dbConnect(){
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', ''); 

        return $database;
}

