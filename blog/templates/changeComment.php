<?php $title = "Le blog de l'AVBN" ?>

<?php ob_start(); ?>
<h1>Modifier le commentaire</h1>
<p>Le commentaire actuellement :</p>
<p><strong><?= htmlspecialchars($selectedComment->author) ?></strong> le <?= htmlspecialchars($selectedComment->frenchCreationDate) ?></p>
<p><?= nl2br(htmlspecialchars($selectedComment->comment)) ?></p>
<form action="index.php?action=changeComment&id=<?= $_GET['id'] ?>&commentid=<?= $selectedComment->commentId ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
</form>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php');