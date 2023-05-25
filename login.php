<?php
session_start();
// Inclusion de la classe TableGenerator
require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php';

// Vérifiez si les données du formulaire ont été envoyées
if (isset($_POST['username']) && isset($_POST['password'])) {
  // Récupérez les données du formulaire
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Échappez les données pour éviter les injections SQL
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);
  // Exécutez la requête SQL pour vérifier si les données de connexion sont correctes
  $result = mysqli_query($conn, "SELECT id, username FROM users WHERE username = '$username' AND password = '$password'");
  if (mysqli_num_rows($result) > 0) {
    // Connexion réussie, récupérez l'ID et le nom d'utilisateur de l'utilisateur
    $user = mysqli_fetch_assoc($result);
    $user_id = $user['id'];
    $username = $user['username'];

    // Stockez l'ID et le nom d'utilisateur en session
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    // Redirigez l'utilisateur vers la page de connexion
    header('Location: index.php');
    exit;
    
  } else {
    // Connexion échouée, stockez l'erreur dans la variable de session et redirigez vers la page de connexion
    $_SESSION['login_error'] = true;
    header('Location: index.php');
    exit;
  }
}
