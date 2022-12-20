<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Inclusion de Bootstrap -->
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Inclusion de votre fichier de style CSS -->
    <link rel="stylesheet" href="style.css">

    <title>Build It !</title>
  </head>
  <body class="dark-edition">
    <!-- Header -->
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Build It</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="table_management/table_list.php">Gestion des tables</a>
            </li>
          </ul>
        </div>
        <!-- Bouton de connexion/déconnexion -->
        <?php
          // L'utilisateur est connecté, affichez un bouton de déconnexion
          if (isset($_SESSION['user_id'])) {
            ?><span class="welcome-message" style="color: white; margin-left: 10px;">Bonjour, <?php echo $_SESSION['username']; ?></span>&nbsp&nbsp&nbsp<?php
            echo '<a href="logout.php" class="btn btn-dark">Se déconnecter</a>';
          } else {
            // L'utilisateur n'est pas connecté, affichez un bouton de connexion
            echo '<a href="#" class="btn btn-dark" data-toggle="modal" data-target="#loginModal">Se connecter</a>';
          }          
        ?>

        <!-- Modal de connexion -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Formulaire de connexion -->
                <form action="login.php" method="post">
                  <div class="form-group">
                    <label for="usernameInput">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Entrez votre nom d'utilisateur">
                  </div>
                  <div class="form-group">
                    <label for="passwordInput">Mot de passe</label>
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Entrez votre mot de passe">
                  </div>
                  <button type="submit" class="btn btn-dark">Se connecter</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </nav>
    </header>
  </body>
</html>

