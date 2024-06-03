<?php
require_once("../config.php");
require_once("../Controller/entreprises_services.php");
if (!isset($_SESSION['etp'])) {
    session_start();
}
if (isset($_POST['deconnexion'])) {
    session_destroy();
    header("Location: index.php");
}
require_once("menu.php");
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
    <h1>DASHBOARD ENTREPRSIE</h1>
    <?php
    // var_dump($_SESSION['etp']);
    var_dump(getAllStageFromEntreprise($_SESSION['etp']));
    ?>

    <form action="" method="post">
        <button id="button" name="deconnexion" type="submit" class="w-1/2 px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-950 hover:bg-blue-500 hover:shadow-lg focus:outline-none">
            DECONNECTER
        </button>
    </form>
    <a id="button" href="add_stage.php" name="" type="button" class="w-1/2 px-6 py-3 mt-10 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-950 hover:bg-blue-500 hover:shadow-lg focus:outline-none">
        POSTER UNE DEMANDE
    </a>

</body>

</html>