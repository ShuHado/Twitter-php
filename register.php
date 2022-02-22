<?php
require("functions.php");

// on crée un tableau d'erreur
// cela nous permettra de les afficher ensuite dans le HTML
// s'il y en a
$errors = array();

// si on a bien envoyé le formulaire
if (!empty($_POST)) {
      // cas où il manque un champs
      if (empty($_POST["email"]) || empty($_POST["password"])) {
            array_push($errors, "Merci de remplir tous les champs.");
      } else {
            // cas où le compte existe déjà
            if (check_member_exists($_POST["email"])) {
                  array_push($errors, "Un compte avec cet email existe déjà.");
            } else {
                  // cas où on peut créer le compte
                  add_user($_POST["email"], $_POST["password"]);
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
      <title>Twitter - Inscription</title>
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
                  <h1>S'inscrire</h1>

                  <ul class="errors">
                        <?php
                        for ($i = 0; $i < count($errors); $i++) {
                        ?>

                              <li><?php echo $errors[$i]; ?></li>

                        <?php
                        }
                        ?>
                  </ul>
                  <form action="register.php" method="post">

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