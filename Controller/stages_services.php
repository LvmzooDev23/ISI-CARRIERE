<?php
require_once("db.php");

function add_stage($titre, $description, $niveau, $annee, $debutStage, $dureeStage, $deadline, $datePublication, $entreprise)
{
    global $connexion;
    $sql = "INSERT INTO stage 
            VALUES (NULL,'$titre','$description','$niveau','$annee','$debutStage','$dureeStage','$deadline', '$datePublication','$entreprise')";
    $result = mysqli_query($connexion, $sql);
    return $result;
}


function getAllStage()
{
    global $connexion;
    $sql = "SELECT * FROM stage,entreprise 
            WHERE entreprise = idEntreprise
            ORDER BY datePublication ASC";
    $result = mysqli_query($connexion, $sql)->fetch_all(2);
    return $result;
}

function getStageById($id)
{
    global $connexion;
    $sql = "SELECT * FROM stage,entreprise
    WHERE idStage = $id AND stage.entreprise = entreprise.idEntreprise";
    if (mysqli_query($connexion, $sql)) {
        $stage = mysqli_query($connexion, $sql)->fetch_all(2);
        return $stage;
    }
    return null;
}
function getAllStageFromEntreprise($idEntreprise)
{
    global $connexion;
    $sql = "SELECT * FROM stage WHERE entreprise = $idEntreprise";
    if (mysqli_query($connexion, $sql)) {
        $stage = mysqli_query($connexion, $sql)->fetch_all(2);
        return $stage;
    }
    return null;
}
