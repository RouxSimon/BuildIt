<!-- Datatable CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();

    $('.delete-btn').click(function() {
      let row = $(this).closest('tr');
      let id = $(this).data('id');
      $.ajax({
        type: 'DELETE',
        url: './delete.php',
        data: { id: id },
        success: function(response) {
          if (response == 'success') {
            row.remove();
          } else {
            console.log('Erreur lors de la suppression de l\'enregistrement');
          }
        },
        error: function(xhr, status, error) {
          console.log('Erreur lors de l\'envoi de la requête AJAX : ' + error);
        }
      });
    });
  });
</script>

<?php
// Inclusion du fichier de connexion à la base de données
include 'db.php';

// Récupération des données de la base de données
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Affichage de la table de données avec DataTables et Bootstrap
?>
<table id="dataTable" class="table table-dark table-hover table-striped">
  <thead class="thead-dark">
    <tr>
      <th>Username</th>
      <th>Password</th>
      <th>E-mail</th>
      <th>Supprimer</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['password']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><button class="btn btn-danger delete-btn" data-id="<?php echo $row['id']; ?>">Supprimer</button></td>
    </tr>
    <?php
  }
  ?>
  </tbody>
</table>

<?php
// Bouton d'import de fichiers Excel
?>
<form action="import_excel.php" method="post" enctype="multipart/form-data">
  <input type="file" name="file" />
  <input type="submit" name="import" value="Import Excel" />
</form>

<?php

mysqli_close($conn);

?>

