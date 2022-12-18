<?php
// Inclusion de la classe TableGenerator
require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php';

// Récupération du nom de la table et des données du formulaire
$table_name = $_POST['table_name'];
unset($_POST['table_name']);
$data = $_POST;

// Préparation de la requête INSERT
$query = "INSERT INTO $table_name (";
foreach ($data as $field => $value) {
    $query .= "$field, ";
}
$query = rtrim($query, ", ") . ") VALUES (";
foreach ($data as $field => $value) {
    $query .= "'$value', ";
}
$query = rtrim($query, ", ") . ")";

// Exécution de la requête
if (mysqli_query($conn, $query)) {
    // La requête a été exécutée avec succès
    echo "Données enregistrées avec succès.";

    header('Location: table_list.php');
} else {
    // La requête a échoué
    echo "Erreur : " . $query . "<br>" . mysqli_error($conn);
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
