<?php
// le 'once' permet de ne pas réimporter db.php si jamais il a déjà été importé avant
require_once("db.php");

/**
 * Connecte l'utilisateur
 */
function login($email)
{
      global $db;

      $q = $db->prepare("SELECT email, password FROM users WHERE email = :email");

      $q->bindParam(":email", $email);

      $q->execute();

      $user = $q->fetch();

      // si ce n'est pas le bon mot de passe, on retourne faux
      if (!password_verify($_POST["password"], $user["password"])) {
            return false;
      }

      // sinon, on retourne le $user
      // cela permettra de le stocker dans la $_SESSION
      return $user;
}

/**
 * Crée un utilisateur
 */
function add_user($email, $password)
{
      global $db;

      $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

      $q = $db->prepare("INSERT INTO users(email, password, date_inscription) VALUES(:email, :password, CURRENT_DATE())");

      $q->bindParam(":email", $email);
      $q->bindParam(":password", $encrypted_password);

      $q->execute();
}

/**
 * Vérifie si le compte existe déjà
 */
function check_member_exists($email)
{
      global $db;

      $q = $db->prepare("SELECT id FROM users WHERE email = :email");

      $q->bindParam(":email", $email);

      $q->execute();

      // rowCount retourne le nombre de résultats retournés par la requête 
      return $q->rowCount() > 0;
}

function getPostsUSer()
{
      global $db;

      $q = $db->prepare("SELECT message, date, nb_comment, nb_like FROM posts JOIN users ON posts.user_id = users.id");

      $q->execute();

      return $q;
}


function getDataUser()
{
      global $db;

      $query = 'SELECT name, tag, date_inscription, ville, description, nb_abonnements, nb_abonnes, photo_profile, photo_back_profile FROM users';

      $reponse = $db->prepare($query);

      $reponse->execute();

      $user = $reponse->fetch();

      return $user;
}
