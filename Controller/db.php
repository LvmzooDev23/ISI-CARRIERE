<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASSWORD', '');
define('DB_NAME', 'isi_carriere');

try {
    $connexion = mysqli_connect(HOST,USER,PASSWORD,DB_NAME);
} catch (\Throwable $th) {
    echo "ERREUR DE CONNNEXION A LA BASE DE DONNEES";
}

?>