<!--
=========================================================
* BuildIt - v0.0.1
=========================================================

* Coded by Zapp

=========================================================
-->

<?php
// Inclusion de la classe TableGenerator
require_once 'tableGenerator.php';

// Vérification de la soumission du formulaire
if (isset($_POST['submitButton'])) {
    // Récupération des paramètres du formulaire
    $parameters = $_POST;
   
    // Génération de la div contenant la table HTML
    $divHTML = TableGenerator::generateTable($parameters);
   
    // Affichage de la div
    echo $divHTML;
  }
?>

<!DOCTYPE html>
<html lang="en">
    <!-- Chargement de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    
    <form method="post" class="container mt-5">
    <!-- Bouton pour ajouter une ligne -->
    <div class="form-row mb-3">
        <div class="col-4">
        <input type="text" class="form-control" placeholder="Nom de la ligne" id="rowNameInput">
        </div>
        <div class="col-8">
        <button type="button" class="btn btn-primary" id="addRowButton">Ajouter une ligne</button>
        </div>
    </div>
    <!-- Bouton pour ajouter une colonne -->
    <div class="form-row mb-3">
        <div class="col-4">
        <input type="text" class="form-control" placeholder="Nom de la colonne" id="columnNameInput">
        </div>
        <div class="col-8">
        <button type="button" class="btn btn-primary" id="addColumnButton">Ajouter une colonne</button>
        </div>
    </div>
    <!-- Tableau vide qui servira à afficher les données du formulaire -->
    <table id="dataTable" class="table table-bordered">
        <!-- En-tête de la table -->
        <thead>
        <tr>
            <th></th>
        </tr>
        </thead>
        <!-- Corps de la table -->
        <tbody>
        <tr>
            <td></td>
        </tr>
        </tbody>
    </table>
    <button type="submit" name="submitButton" value="Envoyer" class="btn btn-success mt-3">Envoyer</button>
    </form>

</html>

<script>
    document.getElementById('addRowButton').addEventListener('click', function() {
        // Récupération de la table
        var table = document.getElementById('dataTable');
        
        // Création de la nouvelle ligne
        var row = table.insertRow(-1); // -1 indique que la ligne doit être ajoutée à la fin de la table
        
        // Ajout des cellules à la ligne
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        
        // Mise en place du contenu des cellules
        cell1.innerHTML = 'Nouvelle ligne';
        cell2.innerHTML = 'Nouvelle ligne';
    });
</script>
<?php
if (isset($_POST['submitButton'])) {
  // Récupération du nombre de lignes et de colonnes de la table
  $numRows = $_POST['numRows'];
  $numColumns = $_POST['numColumns'];
 
  // Récupération des données de chaque cellule de la table
  for ($i = 0; $i < $numRows; $i++) {
    for ($j = 0; $j < $numColumns; $j++) {
      $cellData = $_POST['cell-' . $i . '-' . $j];
      // Traitement de la donnée de la cellule ici...
    }
  }
}
?>


