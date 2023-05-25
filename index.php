<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Inclusion de Bootstrap -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/imports/imports.php'; ?>

    <!-- Inclusion de la bdd -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php'; ?>

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
            <li class="nav-item">
              <a class="nav-link" href="add_module.php">Ajout de module</a>
            </li>
          </ul>
        </div>
        <!-- Bouton de connexion/déconnexion -->
        <?php
          // L'utilisateur est connecté, affichez un bouton de déconnexion
          if (isset($_SESSION['user_id'])) {   

            // Récupérer les modules de l'utilisateur connecté (remplacez l'ID de l'utilisateur si nécessaire)
            $userId = $_SESSION['user_id'];
            $query = "SELECT DISTINCT m.*
                      FROM users u
                      JOIN user_roles ur ON u.id = ur.user_id
                      JOIN roles r ON ur.role_id = r.id
                      JOIN modules m ON r.name = m.droits OR r.name = ''
                      WHERE u.id = $userId";
            $result = mysqli_query($conn, $query);

            // Parcourir les résultats et afficher les modules dans la navbar
            while ($row = mysqli_fetch_assoc($result)) {
              $moduleName = $row['name'];

              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="new_modules/' . $moduleName . '.php">' . $moduleName . '</a>';
              echo '</li>';
            }

            ?><span class="welcome-message" style="color: white; margin-left: 10px;">Bonjour, <?php echo $_SESSION['username']; ?></span>&nbsp&nbsp&nbsp<?php
            echo '<a href="logout.php" class="btn btn-dark">Se déconnecter</a>';
          } else {
            // L'utilisateur n'est pas connecté, affichez un bouton de connexion
            echo '<a href="#" class="btn btn-dark" data-toggle="modal" data-target="#loginModal">Se connecter</a>';
          }          
        ?>

        <!-- Modal de connexion -->
        <div class="modal fade login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
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
                            <button type="submit" class="btn btn-success">Se connecter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // Affichage de la page d'erreur avec fenêtre modale en cas d'échec de connexion
        if (isset($_SESSION['login_error'])) {
            ?>
            <div class="modal" tabindex="-1" role="dialog" id="errorModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Erreur de connexion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Une erreur s'est produite lors de la connexion. Veuillez réessayer.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Réessayer</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $('#errorModal').modal('show');
                });
            </script>
          <?php
            unset($_SESSION['login_error']);
        }
        ?>        
      </nav>
    </header>

    <br><div class="container-fluid">
      <div class="row">
        <div class="col-md-12 offset-md-">
          <div>
            <?php include 'dashboard.php'; ?>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>  

