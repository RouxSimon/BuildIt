<?php
session_start();
// Inclusion de la classe TableGenerator
require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php';

  // Supprimez les données de session
  unset($_SESSION['user_id']);
  unset($_SESSION['username']);
  // Redirigez l'utilisateur vers la page de connexion
  header('Location: index.php');
  exit;
?>
