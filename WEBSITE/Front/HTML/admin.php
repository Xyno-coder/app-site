<?php
session_start();
if($_SESSION['pseudo'] !== "root"){
    header('Location: forbidden.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/admin.css">
    <title>Eklypsse</title>
</head>
<body>
<?php
                // Inclure le fichier header.php
                include 'header.php';
                ?>
    
    <br>
    <br>
    <a href="admin.php" class="Admin" ><h1>Admin</h1></a>
    <br>
    <div class="Lien" >
        <button type="button" name="PublierArticle" class="PublierArticle" ><a href="publier-article.php">Gestion de la FAQ</a></button>
        <button type="button" name="AfficherUser" class="AfficherUser" ><a href="afficher_utilisateur.php">Gestion des utilisateurs</a></button>
        <button type="button" name="ButtonEvent" class="ButtonEvent" ><a href="ButtonEvent.php">Gestion des évènements</a></button>
        <button type="button" name="GestionCommentaire" class="GestionCommentaire" ><a href="Gestion_Commentaire.php">Gestion des commentaires</a></button>
        <button type="button" name="CGU" class="CGU" ><a href="gestion-cgu.php">Modifier les CGU et mentions légales</a></button>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php
                // Inclure le fichier header.php
                include 'footer.php';
                ?>
</body>
</html>