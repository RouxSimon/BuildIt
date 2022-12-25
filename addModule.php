<?php

// Vérifiez si le formulaire a été soumis
if (isset($_POST['submit'])) {
  // Récupère le nom du module entré par l'utilisateur
  $moduleName = $_POST['moduleName'];

  // Crée un nouveau fichier PHP avec le nom du module
  $file = fopen($moduleName . ".php", "w");

  // Écrit les balises de base, le titre et le message d'accueil dans le fichier
  fwrite($file, "<html>\n");
  fwrite($file, "<head>\n");
  fwrite($file, "<title>" . $moduleName . "</title>\n");
  fwrite($file, "</head>\n");
  fwrite($file, "<body>\n");
  fwrite($file, "<h1>" . $moduleName . "</h1>\n");
  fwrite($file, "<p>Bienvenue sur le module " . $moduleName . "</p>\n");
  fwrite($file, "</body>\n");
  fwrite($file, "</html>\n");

  // Ferme le fichier
  fclose($file);
}

?>

<!-- Formulaire pour demander le nom du module -->
<form method="post">
  <label for="moduleName">Nom du module :</label><br>
  <input type="text" id="moduleName" name="moduleName"><br>
  <input type="submit" name="submit" value="Créer un module">
</form> 
