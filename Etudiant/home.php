<?php
require_once("../config.php");
require_once("../Controller/students_services.php");
session_start();
if (isset($_POST['deconnexion'])) {
    session_destroy();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <h1>DASHBOARD ETUDIANTS</h1>
    <?php var_dump($_SESSION['etu']) ?>
    <form action="" method="post">
        <button id="button" name="deconnexion" type="submit" class="w-1/2 px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-950 hover:bg-blue-500 hover:shadow-lg focus:outline-none">
            DECONNECTER
        </button>
    </form>

</body>

</html>