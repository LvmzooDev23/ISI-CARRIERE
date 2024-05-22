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
            <label for="">MAIL</label>
            <input type="email" name="mail" placeholder="exemple@groupeisi.com">
        </div>
        <div>
            <label for="">MOT DE PASSE</label>
            <input type="password" name="password">
        </div>
        <div>
            <button type="submit" name="connexion">CONNEXION</button>
            <button type="reset" name="connexion">ANNULER</button>
            <p>Sinon <a href="add_student.php">s'inscrire ici</a></p>
        </div>
    </form>
    
</body>
</html>