<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<?php
// Inclusion de la classe TableGenerator
require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php';
?>
<body class="bg-dark text-light">
    <?php
    // Récupération du nom de la table sélectionnée
    $table_name = $_POST['table_name'];
    if (isset($_POST['delete'])) {
        $query = "DROP TABLE $table_name";
        if (mysqli_query($conn, $query)) {
            echo'<br>&nbsp&nbsp<a href="table_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a><br>';
            echo '<div class="container mt-5">';    
                // La table a été créée avec succès
                echo '<h3>La table ' . $table_name . ' a été supprimée avec succès !</h3>';
            echo'</div>';
        } else {
            echo'<br>&nbsp&nbsp<a href="table_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a><br>';
            echo '<div class="container mt-5">';    
                // La table n'a pas pu être créée
                echo '<h3>Erreur lors de la suppression de la table : ' . mysqli_error($conn) . '</h3>';
            echo'</div>';
        }
    } elseif ($table_name == '') {
        // Si l'utilisateur a choisi de créer une nouvelle table, on vérifie si un nom de table a été entré
        if (isset($_POST['new_table_name']) && !empty($_POST['new_table_name'])) {
            // Si un nom de table a été entré, on crée la nouvelle table
            $table_name = $_POST['new_table_name'];
            $query = "CREATE TABLE $table_name (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)";
            if (mysqli_query($conn, $query)) {
                echo'<br>&nbsp&nbsp<a href="table_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a><br>';
                echo '<div class="container mt-5">';               
                    // La table a été créée avec succès
                    echo '<h3>La table ' . $table_name . ' a été créée avec succès !</h3>';
                echo'</div>';
            } else {
                echo'<br>&nbsp&nbsp<a href="table_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a><br>';
                echo '<div class="container mt-5">';    
                    // La table n'a pas pu être créée
                    echo '<h3>Erreur lors de la création de la table : ' . mysqli_error($conn) . '</h3>';
                echo'</div>';
            }
        } else {
            echo'<br>&nbsp&nbsp<a href="table_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a><br>';
            echo '<div class="container mt-5">';   
                // Si aucun nom de table n'a été entré, on affiche un message d'erreur
                echo '<h3>Veuillez entrer un nom de table valide !</h3>';
            echo'</div>';
        }
    } else {
        // Si l'utilisateur a sélectionné une table existante, on affiche le formulaire pour remplir la table
        // Récupération de la structure de la table
        $result = mysqli_query($conn, "DESCRIBE $table_name");

        // Affichage du formulaire
        ?>
        <br>&nbsp&nbsp<a href="table_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
        <div class="container mt-5">
            <h3 class="text-center">Remplissez la table <?php echo $table_name; ?> :</h3><?php
            echo '<form action="submit_form.php" method="post" class="mx-auto w-50">';
                while ($row = mysqli_fetch_array($result)) {
                    // Vérification du type de colonne
                    if (($row['Type'] == 'varchar(255)' || $row['Type'] == 'int(11)') &&  $row['Field']!='id') {
                        // Affichage du champ de texte si le type de colonne est "VARCHAR" ou "INT"
                        echo '<div class="form-group">';
                        echo '<label for="' . $row['Field'] . '">' . $row['Field'] . '</label>';
                        echo '<input type="text" class="form-control" id="' . $row['Field'] . '" name="' . $row['Field'] . '">';
                        echo '</div>';
                    }
                }
                echo '<input type="hidden" name="table_name" value="' . $table_name . '">';
            
                // Affichage du bouton de soumission
                echo '<button type="submit" class="btn btn-primary">Envoyer</button>';
            echo '</form>';
        echo '</div>';
    }
echo '<body class="bg-dark">';

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>