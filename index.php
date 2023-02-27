<?php
include_once 'includes/dbh.inc.php';
session_start()
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
  <title>Real Estat</title>
</head>

<body class="bg-light" >
  <?php
  if (isset($_SESSION["Email"])) {
    include('./Nav2.php');
  }else{
  include('./Nav.php');
  }
  ?>
<div class="d-flex justify-content-center align-items-center flex-wrap" style="background-image:url(./img/1677143056-background.jpg);background-size: cover;background-position: center; height: 60vh; position: relative;">
  <!-- Search Form -->
  <form action="" method="POST" class="w-100  m-3">
    <!-- Div For flex -->
    <div class="d-flex flex-wrap justify-content-center align-items-center mx-2 w-100">
      <!-- Type -->
      <div class="form-group col-12 col-sm-6 col-md-4 col-lg-3 m-3">
        <select class="form-select w-100" name="type" aria-label=".form-select example">
          <option value="tout_type">Tout Type :</option>
          <option value="vente">vente</option>
          <option value="location">location</option>
        </select>
      </div>

      <!-- Categorie -->
      <div class="form-group col-12 col-sm-6 col-md-4  col-lg-3 m-3">
        <select class="form-select w-100" name="categorie" aria-label=".form-select example">
          <option value="tout_categorie">Tout Categories</option>
          <option value="appartement">Appartement</option>
          <option value="maison">Maison</option>
          <option value="villa">Villa</option>
          <option value="bureau">Bureau</option>
          <option value="terrain">Terrain</option>
        </select>
      </div>

      <!-- Ville -->
      <div class="form-group col-12 col-sm-6 col-md-4 col-lg-3 m-3">
        <input type="text" class="form-control w-100" name="ville" placeholder="Ville" aria-label="Username" aria-describedby="basic-addon1">
      </div>
      <!-- PRIX  -->
      <div class="d-flex flex-no-wrap col-12 col-sm-6 col-md-8 col-lg-4 " >
      <!-- min -->
      <div class="form-group m-3">
        <div class="input-group">
          <input type="number" step="0.01" min="0" class="form-control" name="min" placeholder="Prix Minimum" aria-label="Amount (to the nearest dollar)">
          <span class="input-group-text">DH</span>
        </div>
      </div>

      <!-- max -->
      <div class="form-group  m-3">
        <div class="input-group">
          <input type="number" step="0.01" min="0" class="form-control" name="max" placeholder="Prix Maximum" aria-label="Amount (to the nearest dollar)">
          <span class="input-group-text">DH</span>
        </div>
      </div>
</div>
      <div class="form-group col-6 col-md-2 col-lg-2 m-3">
        <button name="submit_search" type="submit" class="btn rounded-4 btn-lg btn-info w-100">Search</button>
      </div>
    </div>
  </form>
</div>
  <form method="POST" class="">

<!-- Div For flex -->
<div class="d-flex  justify-content-start w-50 mx-2 mt-5 ">

  <!-- Sort Prix -->
  <select class="form-select mx-1  w-25" name="sort_prix">
    <option value="prix_tout">Trier Le Prix</option>
    <option value="asc">Prix (Ascending)</option>
    <option value="desc">Prix (Descending)</option>
  </select>

  <!-- Sort Date_pub -->
  <select class="form-select mx-1 w-25" name="sort_date">
    <option value="date_pub_tout">Trier La Date</option>
    <option value="asc">Date de publication (Ascending)</option>
    <option value="desc">Date de publication (Descending)</option>
  </select>

  <!-- search -->
  <button name="submit_sort" type="submit" class="btn rounded-4 btn-lg btn-info mx-2 ">Sort</button>

</div>

</form>
  <div class='cards d-flex  align-items-center justify-content-around flex-wrap'>

    <?php
    if (isset($_POST['submit_search'])) {

      

      $selected = false;

      $query = "SELECT * FROM annonce WHERE ";

      if ($_POST["type"] != 'tout_type') {
        if ($selected) {
          $query .= ' AND ';
        };
        $query .= "type='$_POST[type]'";

        $selected = true;
      }

      if ($_POST["categorie"] != 'tout_categorie') {
        if ($selected) {
          $query .= " AND ";
        };
        $query .= "  categorie='$_POST[categorie]' ";

        $selected = true;
      }

      if ($_POST["ville"]) {
        if ($selected) {
          $query .= " AND ";
        };
        $query .= "  ville='$_POST[ville]' ";

        $selected = true;
      }

      if ($_POST["min"] && $_POST["max"]) {
        if ($selected) {
          $query .= " AND ";
        };
        $query .= "  Prix BETWEEN  '$_POST[min]' AND  '$_POST[max]' ";

        $selected = true;
      }

      

      $result = mysqli_query($connect, $query);
      include('./display_visiteur.php');

    } elseif (isset($_POST['submit_sort'])) {
      $sorted = false;
      $sort = "SELECT * FROM annonce ORDER BY ";
      if ($_POST["sort_prix"] != 'prix_tout') {
        if ($sorted) {
          $sort .= ' , ';
        };
        $sort .= "  Prix $_POST[sort_prix]";

        $sorted = true;
      }

      if ($_POST["sort_date"] != 'date_pub_tout') {
        if ($sorted) {
          $sort .= " , ";
        };
        $sort .= "  Date_pub $_POST[sort_date]";

        $sorted = true;
      }
      $result = mysqli_query($connect, $sort);
      include('./display_visiteur.php');
    } else {
      $result = mysqli_query($connect, "SELECT * FROM annonce ORDER BY Date_pub ASC");
      include('./display_visiteur.php');
    }



    ?>
  </div>

</body>

</html>