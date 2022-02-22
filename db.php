<?php
try {
      // il faudra sûrement changer quelques infos pour vous
      $db = new PDO("mysql:host=localhost;dbname=twitter;", "root", "root");
      // permet d'attraper une erreur SQL si elle survient (désactivé par défaut)
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
}

// function getCategories()
// {
//       global $db;

//       $query = 'SELECT id, name, color FROM categories';

//       $reponse = $db->prepare($query);

//       $reponse->execute();

//       return $reponse;
// }
