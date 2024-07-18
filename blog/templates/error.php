<?php $title = "Oops !" ?>

<?php ob_start(); ?>
<h1>Erreur 404 !</h1>
<p>Il y a une petite erreur : <?php echo $errorMessage?></p>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php');