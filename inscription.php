<?php
include_once 'includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
if (isset($_POST["ajouter"])) {
  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $Conf_password = $_POST["Conf_password"];
  $tel = $_POST["tel"];

  $RequetClientSelect_Email = mysqli_query($connect, "SELECT * FROM client WHERE  Email_cl = '$email'");

  if (!preg_match("/^[a-zA-Z-' ]*$/", $nom) or strlen($nom) < 2) {
    $nom_arr =  "Veuillez saisir votre nom";
  } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $prenom) or strlen($prenom) < 2) {
    $prenom_err =  "Veuillez saisir votre prenom";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_err = "Veuillez saisir un email correct";
  } elseif (!preg_match("/^[0-9]*$/", $tel) or strlen($tel) < 9) {
    $tel_err = "Veuillez saisir un teléphone correct";
  } else {
    if ($RequetClientSelect_Email->fetch_assoc()) {
      $exist_mail = "Cet email existe déja veuillez saisir un autre";
    } elseif ($password !== $Conf_password) {
      $confirm_password = " Vous n'avez pas saisie le méme mot de passe";
    } else {
      $pass = password_hash($password, PASSWORD_DEFAULT);
      $ajout_client = "INSERT INTO `client` (`Nom_cl`, `Prenom_cl`, `Email_cl`, `Mot_passe`, `Num_Tel`) VALUES ('$nom', '$prenom', '$email', '$pass', '$tel')";
      $RequetAjoutClient = mysqli_query($connect, $ajout_client);
      header("Location:./index.php");
      $_SESSION["Email"] = $login;
      $_SESSION["Id"] = $ligneL["Id_cl"];
      $_SESSION["Nom"] = $ligneL["Nom_cl"];
      $_SESSION["Prenom"] = $ligneL["Prenom_cl"];
      $_SESSION["MotPasse"] = $password;
      $_SESSION["Tel"] = $ligneL["Num_tel"];
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <title>Inscription</title>
</head>

<body class="bg-light">


  <div class='d-flex mt-5 align-items-center justify-content-around flex-wrap'>

    <div class="login-box bg-dark mt-5">
      <h2 class="text-info">Login</h2>

      <form action="" method="POST">

        <div class="user-box">
          <input type="text" name="nom" required>
          <label>Nom : </label>
          <span class="text-danger "><?php echo $nom_arr ?> </span>
        </div>
        <div class="user-box">
          <input type="text" name="prenom" required>
          <label>Prénom :</label>
          <span class="text-danger "><?php echo $prenom_err ?> </span>
        </div>
        <div class="user-box">
          <input type="email" name="email" required>
          <label>Adresse Email :</label>
          <span class="text-danger "><?php echo $email_err;
                                      $exist_mail ?> </span>
        </div>
        <div class="user-box">
          <input type="password" name="password" required>
          <label>Mot de Pass :</label>
          <span class="text-danger "></span>
        </div>
        <div class="user-box">
          <input type="password" name="Conf_password" required>
          <label>Confirmer le mot de passe :</label>
          <span class="text-danger "><?php echo $confirm_password ?> </span>

        </div>
        <div class="user-box">
          <input type="tel" name="tel" required>
          <label>Numéro de téléphone :</label>
          <span class="text-danger "><?php echo $tel_err ?> </span>
        </div>

        <a href="#">
          <button type="submit " name="ajouter" class="btn rounded-4 btn-lg text-light ">S'inscrire</button>
          <span></span>
          <span></span>
          <span></span>
          <span></span>

        </a>



      </form>
    </div>
  </div>

</body>

</html>