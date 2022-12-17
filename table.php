<?php

// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "buildit";

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Récupération des données de la base de données
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Affichage de la table de données avec DataTables et Bootstrap
echo "<table id='dataTable' class='table table-dark table-hover table-striped'>\n";
echo "  <thead class='thead-dark'>\n";
echo "    <tr>\n";
echo "      <th>Username</th>\n";
echo "      <th>Password</th>\n";
echo "      <th>E-mail</th>\n";
echo "    </tr>\n";
echo "  </thead>\n";
echo "  <tbody>\n";
while ($row = mysqli_fetch_array($result)) {
  echo "    <tr>\n";
  echo "      <td>" . $row['username'] . "</td>\n";
  echo "      <td>" . $row['password'] . "</td>\n";
  echo "      <td>" . $row['email'] . "</td>\n";
  echo "    </tr>\n";
}
echo "  </tbody>\n";
echo "</table>\n";

// Initialisation de DataTables
echo "<script>\n";
echo "  $(document).ready(function() {\n";
echo "    $('#dataTable').DataTable();\n";
echo "  });\n";
echo "</script>\n";

// Bouton d'import de fichiers Excel
echo "<form action='import.php' method='post' enctype='multipart/form-data'>\n";
echo "  <input type='file' name='file' />\n";
echo "  <input type='submit' name='import' value='Import Excel' />\n";
echo "</form>\n";

mysqli_close($conn);

?>

