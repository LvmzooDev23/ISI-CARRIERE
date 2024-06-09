<?php
session_start();
require_once("../Controller/entreprises_services.php");
if (isset($_SESSION['etp'])) {
    $candidatures = getAllCandidatures($_SESSION['etu']);
    require_once("menu.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php var_dump($candidatures) ?>
</body>

</html>