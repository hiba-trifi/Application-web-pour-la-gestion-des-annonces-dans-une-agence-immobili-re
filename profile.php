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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
  <title>Your profile</title>
</head>

<body class="bg-light">

  <nav class='navbar navbar-expand-lg  p-3  bg-dark'>
    <div class='container-fluid '>
      <a class='navbar-brand' href='#'><img src="./img/logodark.png" class="w-50" alt=""></a>
  
      <div class='collapse navbar-collapse d-flex justify-content-end w-100 ' id='navbarSupportedContent'>
        <a href='./deconnecter.php' class='btn border btn-lg  rounded-pill text-info mx-3' type='button'> Se deconnecter </a>
        <a href='./index.php' class='btn border btn-lg rounded-pill text-info mx-3' type='button'><i class="fa-solid fa-house-user"></i></a>  
        <a href='./edit_profile.php' class='btn border btn-lg rounded-pill text-info mx-3' type='button'>  <i class="fa-solid fa-user-pen"></i></a>
      </div>
    </div>
  </nav>

 
 
  <div class="d-flex  justify-content-start w-50 mx-2 mt-5 ">
    <a href='ajouter.php' class='btn border bg-info btn-lg  rounded-pill text-dark mx-3' type='button'>Ajouter une Annonce <i class="fa-sharp fa-solid fa-plus"></i></a>
  </div>
  <div class='cards d-flex  align-items-center justify-content-around flex-wrap'>

    <?php
    $query = "SELECT * FROM annonce  INNER JOIN client ON client.Id_cl=annonce.Id_cl  WHERE client.Id_cl=$_SESSION[Id]";
    $result = mysqli_query($connect, $query);
    include('./display_client.php');
    
    ?>
  </div>
 
 
</body>

</html>

