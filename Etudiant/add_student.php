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
            <label for="">NOM</label>
            <input type="text" name="nom" id="">
        </div>
        <div>
            <label for="">PRENOM</label>
            <input type="text" name="prenom" id="">
        </div>
        <div>
            <label for="">MAIL</label>
            <input type="email" name="mail" placeholder="exemple@groupeisi.com">
        </div>
        <div>
            <label for="">TELEPHONE</label>
            <input type="text" name="telephone" id="">
        </div>
        <div>
            <label for="">NIVEAU</label>
            <select name="niveau" id="">
                <option value="L1">LICENCE 1</option>
                <option value="L2">LICENCE 2</option>
                <option value="L3">LICENCE 3</option>
                <option value="M1">MASTER 1</option>
                <option value="M2">MASTER 2</option>
            </select>
        </div>
        <div>
            <label for="">SPECIALITE</label>
            <select name="specialite" id="">
                <option value=""></option>
            </select>
        </div>
    </form>
    
</body>
</html>