<!-- Inclusion de Bootstrap -->
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<?php
// Inclusion de la classe TableGenerator
require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php';

// Récupération de la liste des tables
$result = mysqli_query($conn, "SHOW TABLES");

// Affichage de la liste des tables
?>
<!-- Affichage du formulaire -->
<body class="bg-dark text-light">
    <br>&nbsp&nbsp<a href="../index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
        <div class="container mt-5">
            <h3>Sélectionnez une table ou créez une nouvelle :</h3><br>
            <form action="generate_form.php" method="post" class="form-inline">
            <div class="form-group mb-2">
                <select name="table_name" class="form-control">
                <option value="">Créer une nouvelle table</option>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="new_table_name" placeholder="Entrez le nom de la nouvelle table" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Valider</button>&nbsp&nbsp
            <!-- Autres éléments du formulaire -->
            <button type="submit" name='delete' class="btn btn-danger mb-2"><i class="fas fa-trash"></i> Supprimer</button>
    </div>
</body>
<?php

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
