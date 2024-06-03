<?php
require_once("db.php");
require_once("stages_services.php");


function verifyPhoneStudents($telephone)
{
    $operateur = substr($telephone, 0, 2);
    $listeOpe = ["75", "76", "77", "78"];
    if (!in_array($operateur, $listeOpe) || strlen($telephone) != 9) {
        return false;
    }
    return true;
}

function verifyEmailStudents($email)
{
    $domaine = substr($email, (strlen($email) - 14), 14);
    if ($domaine != "@groupeisi.com") {
        return false;
    }
    return true;
}
function add_student($nom, $prenom, $mail, $password, $telephone, $niveau, $specialite)
{
    global $connexion;
    $sql = "INSERT INTO etudiant 
            VALUES (NULL,'$nom','$prenom','$mail','$password','$telephone','$niveau','$specialite')";
    $result = mysqli_query($connexion, $sql);
    return $result;
}

function allStudents()
{
    global $connexion;
    $sql = "SELECT * FROM etudiant";
    mysqli_query($connexion, $sql)->fetch_all(2);
}

function getStudentById($id)
{
    global $connexion;
    $sql = "SELECT * FROM etudiant WHERE idEtudiant =$id";
    if (mysqli_query($connexion, $sql)) {
        $etudiant = mysqli_query($connexion, $sql)->fetch_all(2);
        return $etudiant;
    }
    return null;
}

function login_student($email, $password)
{
    global $connexion;
    $sql = "SELECT idEtudiant FROM etudiant WHERE mailEtudiant='$email' 
                                    AND motDePasseEtudiant='$password'";
    if (mysqli_query($connexion, $sql)) {
        $etudiant = mysqli_query($connexion, $sql)->fetch_all(2);
        session_start();
        $_SESSION['etu'] = $etudiant[0][0];
        return 1;
    } else {
        // header("Location: ../Etudiant/index.php");
        return 0;
    }
}
