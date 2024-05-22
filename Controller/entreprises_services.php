<?php
    require_once("db.php");
    
    function add_entreprise($nom,$secteur,$adresse,$telephone,$mail,$password){
        global $connexion;
        $sql = "INSERT INTO entreprise
                VALUES (NULL,'$nom','$secteur','$adresse','$telephone','$mail','$password')";
        $result = mysqli_query($connexion,$sql);
        return $result;
    }

    function allEntreprises() {
        global $connexion;
        $sql = "SELECT * FROM entreprise";
        mysqli_query($connexion, $sql)->fetch_all(2);
    }

    function getEntrepriseById($id){
        global $connexion;
        $sql = "SELECT * FROM entreprise WHERE idEntreprise='$id' ";
        mysqli_query($connexion,$sql)->fetch_all(2);
    }
?>