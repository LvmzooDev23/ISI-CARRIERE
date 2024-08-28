<?php
require_once("db.php");
require_once("stages_services.php");

function verifyPhoneEntreprise($telephone)
{
    $operateur = substr($telephone, 0, 2);
    $listeOpe = ["33", "75", "76", "77", "78"];
    if (!in_array($operateur, $listeOpe) || strlen($telephone) != 9) {
        return false;
    }
    return true;
}

function verifyEmailEntreprise($email)
{
    $domaine = substr($email, (strlen($email) - 10), 10);
    if ($domaine == "@gmail.com") {
        return false;
    }
    return true;
}

function add_entreprise($nom, $secteur, $adresse, $telephone, $mail, $password)
{
    global $connexion;
    $sql = "INSERT INTO entreprise
            VALUES (NULL,'$nom','$secteur','$adresse','$telephone','$mail','$password')";
    $result = mysqli_query($connexion, $sql);
    return $result;
}

function getAllEntreprises()
{
    global $connexion;
    $sql = "SELECT * FROM entreprise";
    $result = mysqli_query($connexion, $sql)->fetch_all(2);
    return $result;
}

function getEntrepriseById($id)
{
    global $connexion;
    $sql = "SELECT * FROM entreprise WHERE idEntreprise=$id";
    $resultat = mysqli_query($connexion, $sql)->fetch_all(2);
    return $resultat;
}
function login_entreprise($email, $password)
{
    global $connexion;
    $sql = "SELECT idEntreprise FROM entreprise WHERE mailEntreprise='$email' 
                                    AND passwordEntreprise='$password'";
    if (mysqli_query($connexion, $sql)) {
        $entreprise = mysqli_query($connexion, $sql)->fetch_all(2);
        session_start();
        $_SESSION['etp'] = $entreprise[0][0];
        return 1;
    } else {
        // header("Location: ../Etudiant/index.php");
        return 0;
    }
}
function getAllCandidaturesFromEntreprise($idEntreprise)
{
    global $connexion;
    $sql = "SELECT * FROM stage,candidature,etudiant,entreprise 
            WHERE stage.entrepriseStage = entreprise.idEntreprise 
            AND candidature.stageCandidature = stage.idStage
            AND stage.entrepriseStage = '$idEntreprise'
            AND candidature.etudiantCandidature = etudiant.idEtudiant";

    $result = mysqli_query($connexion, $sql)->fetch_all(1);
    return $result;
}
