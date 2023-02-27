<?php
include_once 'includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);

session_start();
if (isset($_POST["connecter"])) {
    $login = $_POST["email"];
    $password = $_POST["pass"];

    if (empty($login)) {
        echo "Veuillez saisir votre email";
    } elseif (empty($password)) {
        echo "Veuillez saisir votre mot de passe";
    } else {
        $RequetClient_Login = mysqli_query($connect, "SELECT * FROM client WHERE Email_cl = '$login'");
        $RequetClient_Password = mysqli_query($connect, "SELECT * FROM client WHERE Mot_passe = '$password' AND Email_cl = '$login' ");

        $ligneL = $RequetClient_Login->fetch_assoc();
        $ligneP = $RequetClient_Password->fetch_assoc();

        if (!$ligneL) {
            $email_err = " <i class='fa-sharp fa-solid fa-circle-exclamation'></i>  L'email saisi est un incorrect";
        } elseif (!$ligneP && !password_verify($password, $ligneL["Mot_passe"])) {
            $password_err = " <i class='fa-sharp fa-solid fa-circle-exclamation'></i>  Mot de passe saisi est un incorrect";
        } else {
            header("Location:./index.php");
            $_SESSION["Email"] = $login;
            $_SESSION["Id"] = $ligneL["Id_cl"];
            $_SESSION["Nom"] = $ligneL["Nom_cl"];
            $_SESSION["Prenom"] = $ligneL["Prenom_cl"];
            $_SESSION["MotPasse"] = $password;
            $_SESSION["Tel"] = $ligneL["Num_Tel"];
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

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Connexion</title>
</head>

<body class="bg-light">
    <div class=' d-flex mt-5  align-items-center justify-content-around flex-wrap'>

        <div class="login-box bg-dark mt-5">
            <h2 class="text-info">Login</h2>
            <form action="" method="POST">
                <div class="user-box">
                    <input type="text" name="email" required="">
                    <label>Adresse Email :</label>
                    <span class="text-danger "><?php echo $email_err ?> </span>
                </div>
                <div class="user-box">
                    <input type="password" name="pass" required="">
                    <label>Mot de pass : </label>
                    <span class="text-danger "><?php echo $password_err ?> </span>
                </div>

                <a href="#">
                    <button type="submit " name="connecter" class="btn rounded-4 text-light btn-lg">Connecter</button><span></span><span></span><span></span><span></span></a>
            </form>
        </div>
    </div>
</body>

</html>