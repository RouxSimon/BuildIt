<!--
=========================================================
* BuildIt - v0.0.1
=========================================================

* Coded by Zapp

=========================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Chargement des fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Chargement des fichiers JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<br>
<br>
<div style="margin-left:20px; width:80%;">
    <form id="table-form" class="form-inline">
    <div class="form-group mb-2">
        <label for="add-row" class="sr-only">Ajouter une ligne</label>
        <input type="text" class="form-control" id="add-row" placeholder="Entrez le nom de la ligne">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="add-column" class="sr-only">Ajouter une colonne</label>
        <input type="text" class="form-control" id="add-column" placeholder="Entrez le nom de la colonne">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
    </form>

    <table id="table" class="table">
    <!-- Le tableau sera généré ici -->
    </table>
</div>

<script>
  // Capturez le formulaire et utilisez les données pour ajouter une ligne ou une colonne au tableau
  document.getElementById('table-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var rowName = document.getElementById('add-row').value;
    var columnName = document.getElementById('add-column').value;
    if (rowName) {
      // Ajoutez une nouvelle ligne au tableau
      var table = document.getElementById('table');
      var row = table.insertRow();
      var cell = row.insertCell();
      cell.innerHTML = rowName;
      // Réinitialisez le champ de saisie pour la ligne
      document.getElementById('add-row').value = '';
    } else if (columnName) {
      // Ajoutez une nouvelle colonne au tableau
      var rows = table.rows;
      for (var i = 0; i < rows.length; i++) {
        var cell = rows[i].insertCell();
        if (i === 0) {
          // Ajoutez le nom de la colonne en en-tête de tableau
          cell.innerHTML = columnName;
        }
      }
      // Réinitialisez le champ de saisie pour la colonne
      document.getElementById('add-column').value = '';
    }
  });
</script>



<?php
  // Inclusion du fichier de connexion à la base de données
  include 'db.php';

  // Vérifiez que les données du tableau sont envoyées en POST
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du tableau
    $rows = isset($_POST['rows']) ? $_POST['rows'] : array();
    $columns = isset($_POST['columns']) ? $_POST['columns'] : array();
    // Vérifiez que les données du tableau sont des tableaux
    if (is_array($rows) && is_array($columns)) {
      // Initialisez la connexion à la base de données
      $conn = mysqli_connect("localhost", "username", "password", "database_name");
      // Créez une requête SQL pour créer une table avec ces lignes et colonnes
      $sql = "CREATE TABLE table_name (";
      // Ajoutez chaque ligne en tant que champ de la table
      foreach ($rows as $row) {
        $sql .= "$row VARCHAR(255),";
      }
      // Ajoutez chaque colonne en tant que champ de la table
      foreach ($columns as $column) {
        $sql .= "$column VARCHAR(255),";
      }

      // Supprimez la virgule finale et ajoutez la parenthèse fermante
      $sql = rtrim($sql, ",");
      $sql .= ")";
      // Exécutez la requête SQL pour créer la table
      mysqli_query($conn, $sql);
    }
  }
?>