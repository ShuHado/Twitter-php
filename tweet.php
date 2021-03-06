<?php

require("functions.php");
session_start();
$user = $_SESSION['user'];


if (!empty($_GET['post_id'])) {

      $post_id = $_GET['post_id'];
}


if (isset($_POST['message'])) {
      $message = $_POST['message'];
      $query = "INSERT INTO posts(message,hour,post_id,user_id) VALUES (:message,CURRENT_TIME,:post_id,:user_id);";
      try {
            // préparation de la requête et exécution
            $q = $db->prepare($query);
            // ça permet de remplacer les variables présents dans la requête SQL (précédées par le symbole ':')
            // par les vraies variables qu'on a récupérées de notre formulaire
            $q->bindParam(":message", $message);

            $q->bindParam(":post_id", $post_id);

            $q->bindParam(":user_id", $user['id']);

            $q->execute();

            // si jamais une erreur survient, on l'affiche
      } catch (PDOException $e) {
            echo "Erreur dans la base de données : " . $e->getMessage();
      } catch (Exception $e) {
            echo "Erreur PHP : " . $e->getMessage();
      }
}

$post = getPost($post_id);
$comment = getCommentPost($post_id);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Twitter - Fil d'actus</title>
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
      <div class="center">
            <div class="tweet">
                  <div class="profile">
                        <img class="image-profil" src="<?php echo $post['photo_profile']; ?>" alt="Squeezie">
                  </div>
                  <div class="tweet-right">
                        <header>
                              <h3><?php echo $post['name']; ?></h3>
                              <svg class="user-verif" viewBox="0 0 24 24" aria-label="Compte certifié" class="r-1cvl2hr r-4qtqp9 r-yyyyoo r-1xvli5t r-9cviqr r-f9ja8p r-og9te1 r-bnwqim r-1plcrui r-lrvibr">
                                    <g>
                                          <path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z"></path>
                                    </g>
                              </svg>
                        </header>
                        <h3 class="user"><?php echo $post['tag']; ?></h3>
                        <p class="message">
                              <?php echo $post['message']; ?>
                        </p>
                        <div class="time-date">
                              <h3 class="time"><?php echo $post['hour']; ?></h3>
                              <h3 class="dot">·</h3>
                              <h3 class="date"><?php echo $post['hour']; ?></h3>
                        </div>
                        <div class="likes">
                              <h3><?php echo $post['nb_like']; ?></h3>
                              <p>j'aime</p>
                        </div>
                  </div>
            </div>
            <div class="tweet">
                  <div class="tweet-right">
                        <footer class="right">
                              <span>
                                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi">
                                          <g>
                                                <path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path>
                                          </g>
                                    </svg>
                              </span>
                              <span>
                                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi">
                                          <g>
                                                <path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"></path>
                                          </g>
                                    </svg>
                              </span>
                        </footer>
                  </div>
            </div>
            <form id="form" class="formulaire" action="tweet.php?post_id=<?php echo $post_id; ?>" method="post">
                  <img src="<?php echo $user['photo_profile']; ?>" alt="Joueur du Grenier">
                  <textarea placeholder="Quoi de neuf ?" cols="30" rows="5" name="message"></textarea>
                  <button>Répondre</button>
            </form>
            <?php
            while ($donnees = $comment->fetch()) {
            ?>
                  <div class="tweet">
                        <div class="profile">
                              <img class="image-profil" src="<?php echo $donnees['photo_profile']; ?>" alt="Squeezie">
                        </div>
                        <div class="tweet-right">
                              <header>
                                    <h3><?php echo $donnees['name']; ?></h3>
                                    <svg class="user-verif" viewBox="0 0 24 24" aria-label="Compte certifié" class="r-1cvl2hr r-4qtqp9 r-yyyyoo r-1xvli5t r-9cviqr r-f9ja8p r-og9te1 r-bnwqim r-1plcrui r-lrvibr">
                                          <g>
                                                <path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.998-3.818-3.998-.47 0-.92.084-1.336.25C14.818 2.415 13.51 1.5 12 1.5s-2.816.917-3.437 2.25c-.415-.165-.866-.25-1.336-.25-2.11 0-3.818 1.79-3.818 4 0 .494.083.964.237 1.4-1.272.65-2.147 2.018-2.147 3.6 0 1.495.782 2.798 1.942 3.486-.02.17-.032.34-.032.514 0 2.21 1.708 4 3.818 4 .47 0 .92-.086 1.335-.25.62 1.334 1.926 2.25 3.437 2.25 1.512 0 2.818-.916 3.437-2.25.415.163.865.248 1.336.248 2.11 0 3.818-1.79 3.818-4 0-.174-.012-.344-.033-.513 1.158-.687 1.943-1.99 1.943-3.484zm-6.616-3.334l-4.334 6.5c-.145.217-.382.334-.625.334-.143 0-.288-.04-.416-.126l-.115-.094-2.415-2.415c-.293-.293-.293-.768 0-1.06s.768-.294 1.06 0l1.77 1.767 3.825-5.74c.23-.345.696-.436 1.04-.207.346.23.44.696.21 1.04z"></path>
                                          </g>
                                    </svg>
                                    <h3 class="user"><?php echo $donnees['tag']; ?></h3>
                                    <h3 class="dot">·</h3>
                                    <h3 class="date"><?php echo $donnees['hour']; ?></h3>
                              </header>
                              <p>
                                    <?php echo $donnees['message']; ?>
                              </p>
                              <footer>
                                    <span>
                                          <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi">
                                                <g>
                                                      <path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path>
                                                </g>
                                          </svg>
                                          <?php echo $donnees['nb_comment']; ?>
                                    </span>
                                    <span>
                                          <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi">
                                                <g>
                                                      <path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"></path>
                                                </g>
                                          </svg>
                                          <?php echo $donnees['nb_like']; ?>
                                    </span>
                              </footer>
                        </div>
                  </div>
            <?php
            }
            ?>
      </div>
</body>

</html>