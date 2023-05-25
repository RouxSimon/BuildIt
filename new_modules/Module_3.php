<html>
  <head>
    <?php require_once 'C:/Users/simro/Documents/Dev/xamp/htdocs/buidIt/BuildIt/imports/imports.php'; ?>
    <?php require_once 'C:/Users/simro/Documents/Dev/xamp/htdocs/buidIt/BuildIt/db.php'; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/buidIt/BuildIt/create_block.php'; ?>

    <title>Module_3</title>
  </head>

  <body class='bg-dark text-light'>
    <div class='container mt-5'>
      <h1 class='text-center'>Module_3</h1>
      <p class='lead text-center'>Bienvenue sur le module Module_3</p>
    </div>
    <?php 
    // Récupération du nom de la page actuelle
    $page = basename($_SERVER['PHP_SELF'], '.php');
    echo createBlock($conn, $page);
    ?>
  </body>
</html>