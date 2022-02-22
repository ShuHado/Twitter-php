<?php
// le 'once' permet de ne pas réimporter db.php si jamais il a déjà été importé avant
require_once("db.php");

/**
 * Connecte l'utilisateur
 */
function login($mail)
{

      global $db;

      $q = $db->prepare("SELECT id, email, password, name, tag, description, photo_profile, photo_back_profile, ville, date_inscription, nb_abonnements, nb_abonnes FROM users WHERE email = :email");

      $q->bindParam(":email", $mail);

      $q->execute();

      $user = $q->fetch();

      // si ce n'est pas le bon mot de passe, on retourne faux
      if (!password_verify($_POST["password"], $user["password"])) {
            echo "mauvais mot de passe ou mail";
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

function getPostsUser($id)
{
      global $db;

      $q = $db->prepare("SELECT message, date, nb_comment, nb_like, name, tag, photo_profile FROM posts, users WHERE posts.user_id = $id AND users.id = $id");

      $q->execute();

      return $q;
}

function getPosts()
{
      global $db;

      $q = $db->prepare("SELECT message, date, nb_comment, nb_like, name, tag, photo_profile FROM posts JOIN users ON posts.user_id = users.id");

      $q->execute();

      return $q;
}
