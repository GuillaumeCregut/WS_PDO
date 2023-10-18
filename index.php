<?php
require "config.inc.php";
$pdo=new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
$query="SELECT author, title, content FROM story";
$st=$pdo->query($query);
$stories=$st->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Liste des histoires</title>
</head>
<body>
    <h1>Liste des histoires</h1>
    <p><a href="create.php">Créer une histoire</a></p>
    <main>
        <?php foreach($stories as $story) : ?>
            <div class="story">
                <p>Titre : <?=htmlentities($story['title']) ?></p>
                <p>Auteur : <?=htmlentities($story['author']) ?></p>
                <div>
                    <?=nl2br(htmlentities($story['content'])) ?>
                </div>
            </div>
        <?php endforeach ?>
    </main>
</body>
</html>