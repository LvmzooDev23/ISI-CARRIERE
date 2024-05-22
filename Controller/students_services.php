<?php
    require_once("db.php");
    
    function add_student($nom,$prenom,$mail,$password,$telephone,$niveau,$specialite){
        global $connexion;
        $sql = "INSERT INTO etudiant
                VALUES (NULL,'$nom','$prenom','$mail','$password','$telephone','$niveau','$specialite')";
        $result = mysqli_query($connexion,$sql);
        return $result;
    }

    function allStudents() {
        global $connexion;
        $sql = "SELECT * FROM etudiant";
        mysqli_query($connexion, $sql)->fetch_all(2);
    }

    function getStudentById($id){
        global $connexion;
        $sql = "SELECT * FROM etudiant WHERE idEtudiant='$id' ";
        mysqli_query($connexion,$sql)->fetch_all(2);
    }
?>