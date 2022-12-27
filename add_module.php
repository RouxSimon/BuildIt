<!DOCTYPE html>
<html>
  <head>
    <!-- Inclusion de Bootstrap -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/imports/imports.php'; ?>
    
    <!-- Inclusion de la bdd -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php'; ?>

    <title>Ajout de module</title>
  </head>
  <?php

  // Vérifiez si le formulaire a été soumis
  if (isset($_POST['submit'])) {
    // Récupère le nom du module entré par l'utilisateur
    $moduleName = $_POST['moduleName'];

    // Vérifie si le fichier existe déjà
    $filePath = './new_modules/' . $moduleName . ".php";
    if (file_exists($filePath)) {
      // Affiche un message d'avertissement
      echo '<div class="alert alert-warning alert-dismissible fade show">Le module ' . $moduleName . ' existe déjà. Veuillez entrer un nom de fichier différent.
      <button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    } elseif (empty($moduleName)) {
      // Affiche un message d'erreur
      echo '<div class="alert alert-danger alert-dismissible fade show">Vous devez entrer un nom de module valide.
      <button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    } else {
      // Crée un nouveau fichier PHP avec le nom du module
      $file = fopen($filePath, "w");

      // Écrit les balises de base, le titre et le message d'accueil dans le fichier
      fwrite($file, "  <html>\n");
      fwrite($file, "    <head>\n");
      fwrite($file, "      <?php require_once '");
      fwrite($file,           $_SERVER['DOCUMENT_ROOT']);
      fwrite($file,           "/buidIt/BuildIt/imports/imports.php'; ?>\n");
      fwrite($file, "      <?php require_once '");
      fwrite($file,           $_SERVER['DOCUMENT_ROOT']);
      fwrite($file,           "/buidIt/BuildIt/db.php'; ?>\n");
      fwrite($file, "      <title>" . $moduleName . "</title>\n");
      fwrite($file, "    </head>\n");
      fwrite($file, "    <body class='bg-dark text-light'>\n");
      fwrite($file, "      <div class='container mt-5'>\n");
      fwrite($file, "        <h1 class='text-center'>" . $moduleName . "</h1>\n");
      fwrite($file, "        <p class='lead text-center'>Bienvenue sur le module " . $moduleName . "</p>\n");     
      fwrite($file, "      </div>\n");
      fwrite($file, "    </body>\n");
      fwrite($file, "  </html>\n");
      fclose($file);
    }
  } 
  if (isset($_POST['addSubmodule'])) {
    // Récupère les données du formulaire
    $submoduleName = $_POST['submoduleName'];
    $submoduleType = $_POST['submoduleType'];
    $submoduleHauteur = $_POST['submoduleHauteur'];
    $submoduleLargeur = $_POST['submoduleLargeur'];
    $submoduleSource = $_POST['submoduleSource'];

    // Prépare la requête d'insertion en base de données
    $query = "INSERT INTO blocs (`name`, `type`, hauteur, largeur, source) VALUES ('$submoduleName', '$submoduleType', '$submoduleHauteur', '$submoduleLargeur', '$submoduleSource')";

    // Exécute la requête
    $result = mysqli_query($conn, $query);

    // Vérifie si la requête a réussi
    if ($result) {
      // Affiche un message de succès
      echo '<div class="alert alert-success alert-dismissible fade show">Le sous-module a été ajouté avec succès à la base de données.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    } else {
      // Affiche un message d'erreur
      echo '<div class="alert alert-danger alert-dismissible fade show">Une erreur est survenue lors de l\'ajout du sous-module à la base de données.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    }
  }
  ?>

  <body class="bg-dark text-light">
    <br>&nbsp&nbsp<a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
    <div class="container mt-5">
      <div class="row">
        <!-- Formulaire pour créer un module -->
        <div class="col-6">
          <h3>Entrez le nom du module à créer :</h3><br>
          <form method="post" class="form-inline">
            <div class="form-group mb-2">
              <input type="text" id="moduleName" name="moduleName" placeholder="Entrez le nom du module" class="form-control">
            </div>&nbsp&nbsp
            <button type="submit" name="submit" class="btn btn-primary mb-2">Créer un module</button>
          </form>
        </div>
        <!-- Formulaire pour ajouter un sous-module -->
        <div class="col-6">
          <h3>Ajoutez un sous-module :</h3><br>
          <form method="post">
            <!-- Champ pour entrer le nom du sous-module -->
            <div class="form-group">
              <label for="submoduleName">Nom du sous-module</label>
              <input type="text" id="submoduleName" name="submoduleName" class="form-control">
            </div>
            <!-- Champ pour entrer le type de sous-module -->
            <div class="form-group">
              <label for="submoduleType">Type de sous-module</label>
              <input type="text" id="submoduleType" name="submoduleType" class="form-control">
            </div>
            <!-- Champ pour entrer la hauteur du sous-module -->
            <div class="form-group">
              <label for="submoduleHauteur">Hauteur du sous-module</label>
              <input type="text" id="submoduleHauteur" name="submoduleHauteur" class="form-control">
            </div>
            <!-- Champ pour entrer la largeur du sous-module -->
            <div class="form-group">
              <label for="submoduleLargeur">Largeur du sous-module</label>
              <input type="text" id="submoduleLargeur" name="submoduleLargeur" class="form-control">
            </div>
            <!-- Champ pour entrer la table source du sous-module -->
            <div class="form-group">
              <label for="submoduleSource">Table source</label>
              <input type="text" id="submoduleSource" name="submoduleSource" class="form-control">
            </div>
            <button type="submit" name="addSubmodule" class="btn btn-primary mb-2">Ajouter un sous-module</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>