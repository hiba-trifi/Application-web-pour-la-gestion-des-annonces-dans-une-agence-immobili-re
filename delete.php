<?php 
include_once 'includes/dbh.inc.php';
session_start();

if (isset($_POST['delete'])) {
    $id_ac = $_POST['id_ac'];
    mysqli_query($connect, "DELETE FROM Image WHERE Id_ac = '$id_ac'");
    mysqli_query($connect, "DELETE FROM Annonce WHERE Id_ac = '$id_ac'");
    header('location:./profile.php');
}


?>
