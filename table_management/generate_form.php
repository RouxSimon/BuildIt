<?php require_once 'C:/Users/simro/Documents/Dev/xamp/htdocs/buidIt/BuildIt/imports/imports.php'; ?>

<?php
// Inclusion de la classe TableGenerator
require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php';
?>
<body class="bg-dark text-light">
    <?php
    // Récupération du nom de la table sélectionnée
    if(isset($_POST['table_name'])){
        $table_name = $_POST['table_name'];
    } else {
        $table_name = $_GET['table_name'];
    }
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
            <h3 class="text-center">Remplissez la table <?php echo $table_name; ?> :</h3>
            
            <form action="submit_form.php" method="post" class="control-label col-sm-12">
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <?php if (($row['Type'] == 'varchar(255)' || $row['Type'] == 'int(11)') &&  $row['Field']!='id') { ?>
                        <!-- Affichage du champ de texte si le type de colonne est "VARCHAR" ou "INT" -->
                        <div class="form-group">
                            <label for="<?php echo $row['Field']; ?>"><?php echo $row['Field']; ?></label>
                            <input type="text" class="form-control" id="<?php echo $row['Field']; ?>" name="<?php echo $row['Field']; ?>">
                        </div>
                    <?php } ?>
                <?php } ?>
                <input type="hidden" name="table_name" value="<?php echo $table_name; ?>">
                <!-- Affichage du bouton de soumission -->
                <button type="submit" class="btn btn-primary">Envoyer</button><br>
            </form><br>

            <h3 class="text-center">Ajouter une colonne :</h3>

            <form action="add_column.php" method="post" class="form-horizontal">
                <input type="hidden" name="table_name" value="<?php echo $table_name; ?>">
                <div class="form-group">
                    <label for="column_name" class="control-label col-sm-2">Nom de la colonne :</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="column_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_type" class="control-label col-sm-2">Type de données :</label>
                    <div class="col-sm-12">
                        <select name="data_type" class="form-control">
                            <option value="int">INT</option>
                            <option value="varchar(255)">VARCHAR</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-12">
                        <button type="submit" name="add_column" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter colonne</button>
                    </div>
                </div>
            </form>
            
        </div>
        <?php
    }
echo '<body class="bg-dark">';

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>