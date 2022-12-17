
<?php
require_once './PHPExcel/Classes/PHPExcel.php';

// Vérifie que le formulaire a été soumis
if (isset($_POST['import'])) {
  // Connexion à la base de données
  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "buildit";

  $conn = mysqli_connect($host, $user, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Récupération du fichier Excel
  $file = $_FILES['file']['tmp_name'];

  // Chargement du fichier Excel avec PHPExcel
  require_once 'PHPExcel/Classes/PHPExcel.php';
  $excel = PHPExcel_IOFactory::load($file);
  $worksheet = $excel->getActiveSheet();
  $highestRow = $worksheet->getHighestRow();

  // Insertion des données dans la base de données
  for ($row = 2; $row <= $highestRow; $row++) {
    $column_1 = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $column_2 = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $column_3 = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $sql = "INSERT INTO users (username, `password`, email) VALUES ('$column_1', '$column_2', '$column_3')";
    mysqli_query($conn, $sql);
  }

  mysqli_close($conn);
}
header('Location: index.php');
?>
