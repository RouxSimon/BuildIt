<!DOCTYPE html>
<html>
  <head>
    <!-- Inclusion de Bootstrap -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/imports/imports.php'; ?>

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
      echo '<div class="alert alert-warning">Le module ' . $moduleName . ' existe déjà. Veuillez entrer un nom de fichier différent.</div>';
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
      
    
      /* <!-- 
      // Récupère tous les éléments de la table blocs
      fwrite($file, "        <?php \$query = 'SELECT * FROM blocs';\n");
      fwrite($file, "        \$result = mysqli_query(\$conn, \$query); \n");

      // Vérifie si la requête a réussi
      fwrite($file, "        if (\$result) { ?> \n");
      // Ouvre la liste déroulante dans le fichier
      fwrite($file, "        <select name='blocs' class='form-control'>\n");
      
      // Écrit chaque élément de la table blocs dans la liste déroulante
      fwrite($file, "           <?php while (\$row = mysqli_fetch_array(\$result)) { ?> \n");
      fwrite($file, "             <option value=\"<?php echo \$row['id']; ?>\"><?php echo \$row['type']; ?></option>\n");
      fwrite($file, "           <?php } ?>\n");
      
      // Ferme la liste déroulante dans le fichier
      fwrite($file, "        </select>\n");
      
      // Écrit le bouton "Ajouter" dans le fichier
      fwrite($file, "        <button type='submit' name='add' class='btn btn-primary mt-2'>Ajouter</button>\n");
      */
      
      fwrite($file, "      </div>\n");
      fwrite($file, "    </body>\n");
      fwrite($file, "  </html>\n");
      /* fwrite($file, "<?php } ?>\n"); */
      // Ferme le fichier
      fclose($file);
    }
  }

  ?>

  <body class="bg-dark text-light">
    <br>&nbsp&nbsp<a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
    <div class="container mt-5">
      <h3>Entrez le nom du module à créer :</h3><br>
      <!-- Formulaire pour demander le nom du module -->
      <form method="post" class="form-inline">
        <div class="form-group mb-2">
          <input type="text" id="moduleName" name="moduleName" placeholder="Entrez le nom du module" class="form-control">
        </div>&nbsp&nbsp
        <button type="submit" name="submit" class="btn btn-primary mb-2">Créer un module</button>
      </form>
    </div>
  </body>
</html>