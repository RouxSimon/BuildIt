<?php
// Inclusion du fichier de connexion à la base de données
include 'db.php';

// Récupération de l'ID envoyé par la requête AJAX
$id = $_POST['id'];

// Préparation de la requête DELETE
$query = "DELETE FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

// Liaison des paramètres
mysqli_stmt_bind_param($stmt, "i", $id);

// Exécution de la requête
mysqli_stmt_execute($stmt);

// Vérification du résultat
if (mysqli_stmt_affected_rows($stmt) > 0) {
  // La ligne a été supprimée avec succès
  echo json_encode('success');
} else {
  // La ligne n'a pas pu être supprimée
  echo json_encode('error');
}
