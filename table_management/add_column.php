<?php
// Inclusion de la classe TableGenerator
require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php';

// Récupération des données du formulaire
$table_name = $_POST['table_name'];
$column_name = $_POST['column_name'];
$data_type = $_POST['data_type'];

// Construction de la requête SQL
$query = "ALTER TABLE $table_name ADD $column_name $data_type";
echo $query;

// Exécution de la requête
if (mysqli_query($conn, $query)) {
    // La colonne a été ajoutée avec succès, on redirige vers generate_form.php
    header('Location: generate_form.php?table_name=' . $table_name);
} else {
    // Erreur lors de l'ajout de la colonne
    echo 'Erreur lors de l\'ajout de la colonne : ' . mysqli_error($conn);
}
?>
