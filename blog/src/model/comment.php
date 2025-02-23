<?php

namespace Application\Model\Comment;
use Application\Lib\Database\DataBaseConnection as Marie;

require_once('src/lib/database.php');

class Comment
{
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
    public string $commentId;
}

class CommentRepository
{
    public Marie $connection;

    public function getComments(string $post): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())) {
            $comment = new Comment();
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->commentId = $row['id'];

            $comments[] = $comment;
        }

        return $comments;
    }

    public function createComment(string $post, string $author, string $comment) : bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines > 0);
    }

    public function selectComment($comment){
      
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE id = ?"
        );
        $statement->execute([$comment]);
        
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        if($row){
            $comment = new Comment();
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->commentId = $row['id'];

            return $comment;
        }
    }

    public function changeComment(string $commentId, string $author, string $comment) {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE comments SET author = ?, comment = ? WHERE id = ?"
        );

        return $statement->execute([$author, $comment, $commentId]);
    }

}
