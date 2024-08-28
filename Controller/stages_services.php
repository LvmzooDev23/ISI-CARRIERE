<?php
require_once("db.php");

function add_stage($titre, $description, $niveau, $annee, $debutStage, $dureeStage, $deadline, $datePublication, $entreprise)
{
    global $connexion;
    $sql = "INSERT INTO stage 
            VALUES (NULL,'$titre','$description','$niveau','$debutStage','$dureeStage','$deadline', '$datePublication','$entreprise')";
    $result = mysqli_query($connexion, $sql);
    return $result;
}


function getAllStage()
{
    global $connexion;
    $sql = "SELECT * FROM stage,entreprise 
            WHERE stage.entrepriseStage = entreprise.idEntreprise
            ORDER BY stage.datePubStage ASC";
    $result = mysqli_query($connexion, $sql)->fetch_all(1);
    return $result;
}


function getStageById($id)
{
    global $connexion;
    $sql = "SELECT * FROM stage,entreprise
    WHERE stage.idStage = $id 
    AND stage.entrepriseStage = entreprise.idEntreprise";
    if (mysqli_query($connexion, $sql)) {
        $stage = mysqli_query($connexion, $sql)->fetch_all(1);
        return $stage;
    }
    return null;
}
function getAllStageFromEntreprise($idEntreprise)
{
    global $connexion;
    $sql = "SELECT * FROM stage WHERE stage.entrepriseStage = $idEntreprise";
    if (mysqli_query($connexion, $sql)) {
        $stage = mysqli_query($connexion, $sql)->fetch_all(2);
        return $stage;
    }
    return null;
}
