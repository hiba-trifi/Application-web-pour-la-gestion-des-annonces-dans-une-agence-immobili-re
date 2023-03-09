<?php
include_once 'includes/dbh.inc.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
  <title>Edit your </title>
</head>

<body class="bg-light">

<?php 
include('./Nav2.php');
?>

  <div class='d-flex mt-5  align-items-center justify-content-around flex-wrap'>


    <?php
    if (isset($_POST['edit'])) {
      $id_ac = $_POST['id_ac'];
      $select = mysqli_query($connect, "SELECT * FROM annonce  WHERE Id_ac = '$id_ac'");
      $row = mysqli_fetch_assoc($select);
  }
      if (isset($_POST['confirm_edit'])) {

        $currentDateTime = date('Y-m-d H:i:s');
        $id_ac = $_POST['id_ac'];
        $Superficie = $_POST['Superficie'];
        $Titre = $_POST['Titre'];
        $ville = $_POST['ville'];
        $Prix = $_POST['Prix'];
        $Adresse = $_POST['Adresse'];
        // $Date_pub = $_POST['Date_pub'];
        $type = $_POST['type'];
        $categorie = $_POST['categorie'];
        // $file_count = count($_FILES['images']['name']);

        $edit = mysqli_query($connect, "UPDATE annonce SET categorie = '$categorie' , type = '$type', ville = '$ville',Date_mod = '$currentDateTime', Adresse = '$Adresse' , Superficie = '$Superficie', Titre = '$Titre', Prix = '$Prix'  WHERE Id_ac = '$id_ac'");
      
        if(isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
       
          $file_count = count($_FILES['images']['name']);
          for ($i = 0; $i < $file_count; $i++) {
            $file_name = $_FILES['images']['name'][$i];
            $file_tmp = $_FILES['images']['tmp_name'][$i];
  
            // Generer un unique nom d'image
            $ImgRandom = time() . "-" . $file_name;
            $new_file_path = "./img/" . $ImgRandom;
            $id_ac = $_POST['id_ac'];
            // Stocker le fichier téléchargé
            move_uploaded_file($file_tmp, $new_file_path);
  
            $requeteAjoutImg = "INSERT INTO `image` (`Titre_img`, `img_Principale`,`Id_ac`) VALUES ('$ImgRandom',b'0','$id_ac')";
            $RequetAjoutClient = mysqli_query($connect, $requeteAjoutImg);
          
          }
        }
      


        header('location:./profile.php');
      }
      

$id_ac = $_POST['id_ac'];
$query_count = mysqli_query($connect, "SELECT COUNT(*) AS img_count FROM image WHERE Id_ac = $id_ac");
$row_count = mysqli_fetch_assoc($query_count);
$img_count = $row_count['img_count'];
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'delete_img_') === 0) {
        if ($img_count < 4) { 
           echo  '<script> alert("Une annonce ne peut pas avoir moin de 3 image . Inserer une nouvelle image pour pouvoir suprimer");</script> ';    
        } else {
      $id_img = substr($key, strlen('delete_img_'));

      $query_image = mysqli_query($connect, "SELECT * FROM image WHERE Id_ac = $id_ac AND Id_img = $id_img");
      $row_image = mysqli_fetch_assoc($query_image);

      $img_Principale = $row_image['img_Principale'];

      if ($img_Principale == 0) {
        mysqli_query($connect, "DELETE FROM image WHERE Id_ac = $id_ac AND Id_img = $id_img");
      } else {
        mysqli_query($connect, "UPDATE image SET img_Principale = 1 WHERE Id_ac = $id_ac AND img_Principale = 0 LIMIT 1");
        mysqli_query($connect, "DELETE FROM image WHERE Id_ac = $id_ac AND Id_img = $id_img");
      }
    }
  }
}

  
    ;


    ?>

    <div class="login-box bg-dark my-4">
      <h2 class="text-info">Modifier</h2>
      <form action="" method="POST" class="my-5" enctype="multipart/form-data">

      <span class="text-info"> Les images de l"annonce :</span>

<div class="d-flex mb-5 flex-wrap justify-content-center align-items-center">";

<?php
 $id_ac = $_POST['id_ac'];
   $select = mysqli_query($connect, "SELECT * FROM annonce  WHERE Id_ac = '$id_ac'");
   $row = mysqli_fetch_assoc($select);
$select_image = mysqli_query($connect, "SELECT * FROM image  WHERE Id_ac = '$row[Id_ac]'");
  while ($row_image = mysqli_fetch_assoc($select_image)) {
    echo "
<div class='d-flex  align-items-center  flex-column'>
<div class='car-card mx-2 my-2'>
  <img src='./img/$row_image[Titre_img]' class='car-image'>
  <input type='hidden' name='id_ac' value='$row_image[Id_ac]'>
  <input type='hidden' name='id_img[]' value='$row_image[Id_img]'>
</div>
<button class='btn w-50  btn-info car-button' type='submit' name='delete_img_$row_image[Id_img]'><i class='fa-solid fa-trash'></i></button>
</div>
";
  }
  ; ?> 

</div>

        <div class="user-box">
          <input type="text" id="titre" name="Titre" value=" <?php echo $row['Titre'] ?>" required="">
          <label>Titre d"annonce : </label>
        </div>

      

        <span class="text-info mt-5 "> Inserée une image :</span> </br>
        <input type="file" class="hidden-input rounded-4 my-4 text-light bg-dark" id="image" name="images[]" accept=".jpg, .jpeg, .png, .jfif" multiple>


        <div class="user-box mt-5">
          <input type="text" id="Adresse" name="Adresse" value="<?php echo $row['Adresse'] ?>">
          <label>Adresse : </label>
        </div>


        <div class="user-box">
          <input type="text" name="ville" value="<?php echo $row['ville'] ?>" required="">
          <label> ville:</label>
        </div>

        <div class="user-box">
          <input type="number" id="Superficie" name="Superficie" value="<?php echo $row['Superficie'] ?>" required="">
          <label> Superficie :</label>
        </div>

        <div class="user-box">
          <input type="number" id="Prix" name="Prix" value="<?php echo $row['Prix'] ?>" min="1" required="">
          <label> Prix : </label>
        </div>

        <div class="user-box my-3">
          <select class="form-select bg-dark text-info" aria-label="categorie" id="categorie" name="categorie" required>
            <option value=" <?php echo $row["categorie"] ?>"> L'offre : <?php echo $row["categorie"] ?> </option>
            <option value="Location">Location</option>
            <option value="Vente">Vente</option>
          </select>
        </div>

        <div class="user-box my-3 position-relative">
          <select class="form-select  bg-dark text-info" aria-label="type" id="Type" name="type" required>
            <option value="<?php echo $row['type'] ?>"> La categorie est : <?php echo $row['type'] ?></option>
            <option>Maison</option>
            <option>Villa</option>
            <option>Bureau</option>
            <option>Terrain</option>
          </select>
        </div>

        <a href="#">
                <button type="submit" name="confirm_edit" class="btn rounded-4 text-light btn-lg">Modifier</button><span></span><span></span><span></span><span></span></a>
       
      </form>
    </div>

  </div>

  <!-- <a href="profile.php" class="btn btn-lg btn-info position-absolute top-0 end-0 m-5 ">Go back to profile</a> -->


  <style>
    .car-card {
      width: 140px;
      height: 100px;
      background-color: #f5f5f5;
      border-radius: 8px;
      overflow: hidden;
    }

    .car-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .car-button {
      width: 100%;
      height: 40%;
      transition: background-color 0.2s ease-in-out;
    }
  </style>
</body>

</html>