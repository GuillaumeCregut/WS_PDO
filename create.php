<?php
require "config.inc.php";
$errors=[];
$result=0;
if(!empty($_POST)){
    //vérification de tous les champs
    if(!isset($_POST['title']) || $_POST['title']===''){
        $errors[]='Veuillez donner un titre';
    }else 
        $title=htmlentities($_POST['title']);

    if(!isset($_POST['author']) || $_POST['author']===''){
        $errors[]='Veuillez saisir l\'auteur';

    }else 
        $author=htmlentities($_POST['author']);

    if(!isset($_POST['story']) || $_POST['story']===''){
        $errors[]='Veuillez saisir l\'histoire';
    }else 
        $content=htmlentities($_POST['story']);
    if(empty($errors)){
        //create PDO connection
        $pdo=new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
        //Create Request
        $query='INSERT INTO story(title,author,content) VALUES(:title,:author,:content)';
        $st=$pdo->prepare($query);
        $st->bindValue(':title',$title,PDO::PARAM_STR);
        $st->bindValue(':author',$author,PDO::PARAM_STR);
        $st->bindValue(':content',$content);
        $result=$st->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Création d'une histoire</title>
</head>

<body>
    <h1>Créer votre histoire</h1>
    <main>
    <?php if(!empty($errors)): ?>
        <?php foreach($errors as $error): ?>
            <p><?=$error?></p>
        <?php endforeach ?>
    <?php endif ?>
    <?php if($result!==0): ?>
        <p>L'histoire a bien été ajoutée.</p>
    <?php endif ?>
    <form action="create.php" method="post">
        <div>
            <label for="title">Titre : </label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="author">Auteur : </label>
            <input type="text" name="author" id="author" required>
        </div>
        <div>
            <label for="story">Histoire : </label>
            <textarea name="story" id="story" cols="30" rows="10" required></textarea>
        </div>
        <div class="buttonsLine">
                <button type="submit">Envoyer <img src="images/mail.png"></button>
            </div>
    </form>
</main>
</body>

</html>