<?php
require("functions.php");

// on démarre la session
// sinon, on n'aurait pas accès à $_SESSION
session_start();

// si pas de session utilisateur, c'est qu'il n'est pas connecté
if (empty($_SESSION["user"])) {
      // donc on redirige vers la page de login
      header("Location: login.php");

      // die permet d'arrêter l'exécution de ce script
      die();
}

// on copie la session dans $user
// c'est plus pratique car plus court
$user = $_SESSION["user"];

$user_data = getDataUser();
$postUser = getPostsUser($user['id']);

?>



<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Profil - Twitter</title>
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/style.css">
</head>

<body>

      <div class="center" id="profil">
            <div>
                  <img class="banniere-profil" src="<?php echo $user['photo_back_profile'] ?>" alt="Bannière profil">
                  <img class="image-profil profil" src="<?php echo $user['photo_profile'] ?>" alt="photo de profil">
            </div>

            <div class="info">
                  <div>
                        <h3 class="profile_name"><?php echo $user['name']; ?></h3>
                        <h3 class="user"><?php echo $user['tag']; ?></h3>
                  </div>
                  <button>
                        <h3>Suivre</h3>
                  </button>
            </div>
            <h3 class="description"><?php echo $user['description']; ?></h3>
            <div class="about">
                  <div class="ville">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="r-14j79pv r-4qtqp9 r-yyyyoo r-1xvli5t r-1d4mawv r-dnmrzs r-bnwqim r-1plcrui r-lrvibr">
                              <g>
                                    <path d="M12 14.315c-2.088 0-3.787-1.698-3.787-3.786S9.913 6.74 12 6.74s3.787 1.7 3.787 3.787-1.7 3.785-3.787 3.785zm0-6.073c-1.26 0-2.287 1.026-2.287 2.287S10.74 12.814 12 12.814s2.287-1.025 2.287-2.286S13.26 8.24 12 8.24z"></path>
                                    <path d="M20.692 10.69C20.692 5.9 16.792 2 12 2s-8.692 3.9-8.692 8.69c0 1.902.603 3.708 1.743 5.223l.003-.002.007.015c1.628 2.07 6.278 5.757 6.475 5.912.138.11.302.163.465.163.163 0 .327-.053.465-.162.197-.155 4.847-3.84 6.475-5.912l.007-.014.002.002c1.14-1.516 1.742-3.32 1.742-5.223zM12 20.29c-1.224-.99-4.52-3.715-5.756-5.285-.94-1.25-1.436-2.742-1.436-4.312C4.808 6.727 8.035 3.5 12 3.5s7.192 3.226 7.192 7.19c0 1.57-.497 3.062-1.436 4.313-1.236 1.57-4.532 4.294-5.756 5.285z"></path>
                              </g>
                        </svg>
                        <p><?php echo $user['ville']; ?></p>
                  </div>
                  <div class="inscription">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="r-14j79pv r-4qtqp9 r-yyyyoo r-1xvli5t r-1d4mawv r-dnmrzs r-bnwqim r-1plcrui r-lrvibr">
                              <g>
                                    <path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path>
                                    <circle cx="7.032" cy="8.75" r="1.285"></circle>
                                    <circle cx="7.032" cy="13.156" r="1.285"></circle>
                                    <circle cx="16.968" cy="8.75" r="1.285"></circle>
                                    <circle cx="16.968" cy="13.156" r="1.285"></circle>
                                    <circle cx="12" cy="8.75" r="1.285"></circle>
                                    <circle cx="12" cy="13.156" r="1.285"></circle>
                                    <circle cx="7.032" cy="17.486" r="1.285"></circle>
                                    <circle cx="12" cy="17.486" r="1.285"></circle>
                              </g>
                        </svg>
                        <p>A rejoint Twitter le <?php echo $user['date_inscription']; ?></p>
                  </div>
            </div>
            <div class="follower-followee">
                  <div class="follower">
                        <h3><?php echo $user['nb_abonnements']; ?></h3>
                        <p class="follower">abonnements</p>
                  </div>
                  <div class="followee">
                        <h3><?php echo $user['nb_abonnes']; ?></h3>
                        <p class="followee">abonnés</p>
                  </div>
            </div>

            <?php
            while ($donnees = $postUser->fetch()) {
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
                                    <h3 class="date"><?php echo $donnees['date']; ?></h3>
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
                                          <p><?php echo $donnees['nb_comment']; ?></p>
                                    </span>
                                    <span>
                                          <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi">
                                                <g>
                                                      <path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"></path>
                                                </g>
                                          </svg>
                                          <p><?php echo $donnees['nb_like']; ?></p>
                                    </span>
                              </footer>
                        </div>
                  </div>
            <?php
            };
            ?>
      </div>
</body>

</html>