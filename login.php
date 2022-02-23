<?php
require("functions.php");

session_start();

$errors = array();

if (!empty($_POST)) {
      if (empty($_POST["email"]) || empty($_POST["password"])) {
            array_push($errors, "Merci de remplir tous les champs.");
      }

      if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            if (!check_member_exists($_POST["email"])) {
                  array_push($errors, "Ce compte n'existe pas.");
            } else {
                  $user = login($_POST["email"], $_POST["password"]);

                  if ($user) {
                        $_SESSION["user"] = $user;
                        header("Location: index.php");
                  } else {
                        array_push($errors, "Mauvais email / mot de passe.");
                  }
            }
      }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Twitter - Login</title>
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
      <div class="container">
            <div class="left-side">
                  <img class="twitter-login" src="src/twitter-login.png" alt="">
            </div>

            <div class="right-side">
                  <div class="row">
                        <img class="twitter-logo" src="src/twitter-logo.png" alt="">
                  </div>
                  <form action="login.php" method="post">
                        <p>Se connecter</p>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password">

                        <div class="btn_login">
                              <button>Suivant</button>
                        </div>
                  </form>
            </div>
      </div>
</body>

</html>