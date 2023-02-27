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
    <title>Real Estat</title>
</head>

<body class="bg-light ">
    <?php

    if (isset($_SESSION["Email"])) {
        echo " <nav class='navbar navbar-expand-lg  p-3  bg-dark'>
<div class='container-fluid '>
  <a class='navbar-brand' href='#'><img src='./img/logodark.png' class='w-50' alt=''></a>
  <div class='collapse navbar-collapse d-flex justify-content-end w-100 ' id='navbarSupportedContent'>
    <a href='./index.php' class='btn border btn-lg rounded-pill text-info mx-3' type='button'><i class='fa-solid fa-house-user'></i></a>     
  </div>
</div>
</nav>";
    } else {
        include('./Nav.php');
    }
    ?>

    <div class="my-5 d-flex justify-content-center align-items-center">

        <?php
        if (isset($_GET['Id_ac'])) {
            $Id_ac = $_GET['Id_ac'];
            $query_Annonce = mysqli_query($connect, "SELECT * FROM `annonce` WHERE Id_ac=$Id_ac");


            while ($row = mysqli_fetch_assoc($query_Annonce)) {

                $query_Client = mysqli_query($connect, "SELECT Num_Tel FROM client INNER JOIN annonce ON client.Id_cl=annonce.Id_cl WHERE Id_ac=$Id_ac");
                $row_client = mysqli_fetch_assoc($query_Client);

                $query_img = mysqli_query($connect, "SELECT Titre_img FROM image INNER JOIN annonce ON image.Id_ac=annonce.Id_ac where img_Principale=0 AND image.Id_ac=$row[Id_ac]");

                echo "
               
                <div class='card col-xs-12  col-md-5  col-xl-3 mb-3 w-50 border border-3 border-secondary bg-dark text-light '>
                    <div id='carouselExampleControls' class='carousel  carousel-fade' data-bs-ride='carousel'>
                        <div class='carousel-inner'>";
                while ($row_img = mysqli_fetch_assoc($query_img)) {
                    echo "
                               <div class='carousel-item active '>
                                <img src='./img/$row_img[Titre_img]' class='d-block  w-100 ' style='height:500px;' alt='$row_img[Titre_img]'>
                            </div> ";

                }
                echo "
                        <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleControls' data-bs-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Previous</span>
                        </button>
                        <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleControls' data-bs-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Next</span>
                        </button>
                    </div>
            
            
                    <div class='card-body mx-5'>
                        <div class='d-flex justify-content-between'>
                            <h1 class=' card-title text-info'> $row[Titre]</h1>
                            <h6 class='text-info'>Publiée le : $row[Date_pub]</h6> </div>


                        <ul class='list-group list-group-flush '>
                        <h5 class='mt-3 text-secondary'>Adress :</h5>
                        <li class='list-group-item   bg-dark text-light'>$row[Adresse]</li>
                        <h5 class='mt-3 text-secondary'>Categorie :</h5>
                        <li class='list-group-item  bg-dark text-light'>$row[categorie]</li>
                        <h5 class='mt-3 text-secondary'>Type :</h5>
                        <li class='list-group-item  bg-dark text-light'>Type :$row[type]</li>
                        <h5 class='mt-3 text-secondary'>Superficie :</h5>
                        <li class='list-group-item  bg-dark text-light'>Superficie :$row[Superficie] M²</li>
                        
                        </ul>
                        <div class=' card-footer mt-5 d-flex justify-content-between text-info'>
                        <h3 class='fw-bold  '> Prix : $row[Prix] DH </h4> 
                       <button class='mb-2 btn rounded-4 btn-lg btn-info mx-2   ' data-bs-toggle='modal' data-bs-target='#exampleModal'>Contacter l'annonceur</button>
                           
                        </div>
                        ";

                if (isset($_SESSION["Email"])) {
                    echo "
                              <h6 class='mt-3 text-light'>Date de dernier Modification :$row[Date_mod]</h6>";
                }

                echo "
            
                    </div>
                </div>
            
            
                <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                        <div class='modal-content'>
            
                            <div class='modal-header text-info'>
                                <h1 class='modal-title fs-5' id='exampleModalLabel'>Modal title</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
            
                            <div class='modal-body text-dark'>
                                <h4>Num :</h4>
                                <strong>$row_client[Num_Tel]</strong>
                            </div>
            
                            <div class='modal-footer'>
                                <button type='button' class='btn  btn-info' data-bs-dismiss='modal'>Merci</button>
                            </div>
            
                        </div>
                    </div>
                </div>";
            }
        }
        ?>

    </div>
</body>

</html>