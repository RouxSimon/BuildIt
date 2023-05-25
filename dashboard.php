<!-- Inclusion de Bootstrap -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/imports/imports.php'; ?>

<!-- Inclusion de la bdd -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/db.php'; ?>

<?php 
  // Requête pour récupérer le nombre de modules créées
  $query = "SELECT COUNT(*) as modules FROM modules";
  $result = mysqli_query($conn, $query);
  $result = mysqli_fetch_assoc($result);
  $modules = $result['modules'];

  // Requête pour récupérer le nombre d'utilisateurs
  $query = "SELECT COUNT(*) as users FROM users";
  $result = mysqli_query($conn, $query);
  $result = mysqli_fetch_assoc($result);
  $users = $result['users'];

?>



<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card bg-dark text-white">
        <div class="card-header">
          Modules créés
        </div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $modules; ?></h5>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card bg-dark text-white">
        <div class="card-header">
          Utilisateurs enregistrés
        </div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $users; ?></h5>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-6">
      <div class="card bg-dark text-white">
        <div class="card-header">
          Card 3
        </div>
        <div class="card-body">
          <h5 class="card-title">Contenu de la card 3</h5>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card bg-dark text-white">
        <div class="card-header">
          Card 4
        </div>
        <div class="card-body">
        <h5 class="card-title">Contenu de la card 4</h5>
        </div>
      </div>
    </div>
  </div>
</div>