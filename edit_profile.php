<?php
include_once 'includes/dbh.inc.php';
session_start();
error_reporting(E_ERROR | E_PARSE);
$idCl = $_SESSION["Id"];
$result = mysqli_query($connect, "SELECT * FROM client  WHERE Id_cl=$idCl");
$row = mysqli_fetch_assoc($result);

$nom = $_POST["Nom"];
$prenom = $_POST["Prenom"];
$tel = $_POST["Tel"];
$motp = $_POST["MotP"];
$pass = password_hash($motp, PASSWORD_DEFAULT);
if (isset($_POST["ModCl"])) {
    $RequetClientMod = mysqli_query($connect, "UPDATE `client` SET `Nom_cl` = '$nom', `Prenom_cl` = '$prenom', `Mot_passe` = '$pass', `Num_Tel` = '$tel' WHERE `client`.`Id_cl` = $idCl");
    session_destroy();
    header('location:./index.php');
} elseif (isset($_POST["SupCl"])) {
    while ($ligneAn = $RequetAnnonceSelect->fetch_assoc()) {
        $RequetImageSup = mysqli_query($connect, "DELETE FROM Image WHERE Id_ac = '$ligneAn[Id_ac]'");
        $RequetAnnonceSup = mysqli_query($connect, "DELETE FROM annonce WHERE Id_ac = '$ligneAn[Id_ac]'");
    }
    $RequetClientSup = mysqli_query($connect, "DELETE FROM client WHERE Id_cl = $idCl");
    session_destroy();
    header('location:./index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Modifier mon profile</title>
</head>

<body class="bg-light">

<?php 
include('./Nav2.php');
?>

    <div class='d-flex   mt-5 align-items-center justify-content-around flex-wrap'>

        <div class="login-box bg-dark">
            <h2 class="text-info">Modifier Mon Profile</h2>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="user-box">
                    <span class="text-info">Email: </span>
                    <input type="text" disabled value="<?php echo $row['Email_cl'] ?>" name='titre'>

                </div>

                <div class="user-box">
                    <input name='Nom' value="<?php echo $row['Nom_cl'] ?>">
                    <label>Nom : </label>
                </div>

                <div class="user-box">
                    <input type='text' name='Prenom' value="<?php echo $row['Prenom_cl'] ?>">
                    <label>Prénom:</label>
                </div>

                <div class="user-box">
                    <input type='text' value="<?php echo $row['Num_Tel'] ?>" name='Tel'>
                    <label> Numero de telephone :</label>
                </div>
                
                <div class="user-box mt-4">
                    <input type='text' placeholder="Entrer nouveau password" value="<?php echo $_SESSION["MotPasse"] ?>" name='MotP'>
                    <label> Changer le Mot de pass :</label>
                </div>

                <div class='d-flex '>
                    <a href="#" class='mx-4'>
                        <button type="submit" name="ModCl" class="btn rounded-4 text-light ">Modier </button><span></span><span></span><span></span><span></span></a>

                    <a href="#" class='mx-4'>
                        <button type="submit" name="SupCl" class="btn rounded-4 text-light ">Supprimer </button><span></span><span></span><span></span><span></span></a>
                </div>
            </form>
        </div>
    </div>
    <?php


    ?>
</body>

</html>