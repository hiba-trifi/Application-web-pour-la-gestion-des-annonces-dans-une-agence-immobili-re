<?php
include_once 'includes/dbh.inc.php';
session_start();
error_reporting(E_ERROR|E_PARSE);
$idCl = $_SESSION["Id"];
echo "Client Num:" . $idCl . "<br>";

if (isset($_POST['ajouter'])) {
    $titre = $_POST["titre"];
    $ville = $_POST["ville"];
    $sup = $_POST["superficie"];
    $add = $_POST["adresse"];
    $montant = $_POST["prix"];
    $date = $_POST["date"];
    $type = $_POST["type"];
    $categorie = $_POST["categorie"];
    $file_count = count($_FILES['images']['name']);

    if (strlen($titre) < 200 && strlen($ville) > 3  && strlen($add) > 3 && $sup > 0 && $montant > 0) {
        $requeteAjout = "INSERT INTO annonce(Titre,Prix,Date_pub,Adresse, Superficie,ville,categorie,type,Id_cl) VALUES ('$titre','$montant', '$date','$add', '$sup', '$ville', '$categorie' , '$type',$idCl)";
        $RequetAjoutAnnonce = mysqli_query($connect, $requeteAjout);
        $idderniereligne = $connect->insert_id;

        for ($i = 0; $i < $file_count; $i++) {
            $file_name = $_FILES['images']['name'][$i];
            $file_tmp = $_FILES['images']['tmp_name'][$i];
            // Generer un unique nom d'image
            $ImgRandom = time() . "-" . $file_name;
            $new_file_path = "./img/" . $ImgRandom;
            // Stocker le fichier téléchargé
            move_uploaded_file($file_tmp, $new_file_path);

            // Définir l'image principale
            $is_principal = ($i == 0) ? 1 : 0;
            $image_p = ($is_principal == 1) ? "1" : "0";

            $requeteAjoutImg = "INSERT INTO `image` (`Titre_img`, `img_Principale`, `Id_ac`) VALUES ('$ImgRandom',b'$image_p', $idderniereligne)";
            $RequetAjoutClient = mysqli_query($connect, $requeteAjoutImg);

            header('location:./profile.php');
        }
    }
    
}

?>
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

    <title>Ajouter une annonce</title>
</head>

<body class="bg-light">
    <?php 
include('./Nav2.php');
?>
<div class='d-flex mt-5 align-items-center justify-content-around flex-wrap'>

    <div class="login-box bg-dark ">
        <h2 class="text-info">Ajouter</h2>

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="user-box">
                <input type="text" id='titre' name='titre' required="">
                <label>Titre d'annonce : </label>
            </div>

            <div class="user-box">
                <span class="text-light"> Les images :</span>
                <input type="file" id="image" name="images[]" accept=".jpg, .jpeg, .png, .jfif" multiple required="">
            </div>

            <div class="user-box">
                <input id='Adresse' name='adresse' required="">
                <label>Adresse : </label>
            </div>

            <div class="user-box">
                <input type='text' name='ville' required="">
                <label> Ville:</label>
            </div>

            <div class="user-box">
                <input type='number' id='Superficie' name='superficie' required="">
                <label> Superficie :</label>
            </div>

            <div class="user-box">
                <input type='number' id='prix' name='prix' min="1" required="">
                <label> Prix : </label>
            </div>

            <div class="user-box">
                <span  class="text-light"> Date :</span>
                <input type='date' id='Date' name='date' required="">

            </div>



            <div class="user-box  my-3 ">
                <select class='form-select  bg-dark text-info' aria-label='categorie' id='categorie' name='categorie' required>
                    <option value="Selectionnez un choix">Selectionnez un choix</option>
                    <option value='Location'>Location</option>
                    <option value='Vente'>Vente</option>
                </select>
            </div>

            <div class="user-box my-3 position-relative">
                <select class='form-select  bg-dark text-info' aria-label='type' id='Type' name='type' required>
                    <option value="Selectionnez un choix">Selectionnez un choix</option>
                    <option>Maison</option>
                    <option>Villa</option>
                    <option>Bureau</option>
                    <option>Terrain</option>
                </select>
            </div>

            <a href="#">
                <button type="submit" name="ajouter" class="btn rounded-4 text-light btn-lg">Ajouter</button><span></span><span></span><span></span><span></span></a>
        </form>
    </div>
</div>
</body>

</html>