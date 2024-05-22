<?php
    require_once("../config.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="">NOM ENTREPRISE</label>
            <input type="text" name="nom" id="">
        </div>
        <div>
            <label for="">SECTEUR D'ACTIVITE</label>
            <input type="text" name="secteur" id="">
        </div>
        <div>
            <label for="">ADRESSE ENTREPRISE</label>
            <input type="text" name="adresse" placeholder="adresse">
        </div>
        <div>
            <label for="">TELEPHONE ENTREPRISE</label>
            <input type="text" name="telephone" id="">
        </div>
        <div>
            <label for="">EMAIL ENTREPRISE</label>
            <input type="email" name="email" id="">
        </div>
        <div>
            <label for="">Mot de passe</label>
            <input type="password" name="password" id="">
        </div>
        
    </form>
    
</body>
</html>