<html>
  <head>
    <?php require_once 'C:/Users/simro/Documents/Dev/xamp/htdocs/buidIt/BuildIt/imports/imports.php'; ?>
    <?php require_once 'C:/Users/simro/Documents/Dev/xamp/htdocs/buidIt/BuildIt/db.php'; ?>
    <?php require_once 'C:/Users/simro/Documents/Dev/xamp/htdocs/buidIt/BuildIt/create_block.php'; ?>

    <title>Stats_TFT</title>
  </head>

  <body class='bg-dark text-light'>
    <div class='container mt-5'>
      <h1 class='text-center'>Stats_TFT</h1>
      <p class='lead text-center'>Bienvenue sur le module Stats_TFT</p>
    </div>

    <?php
    // Récupération du nom de la page actuelle
    $page = basename($_SERVER['PHP_SELF'], '.php');
    echo createBlock($conn, $page);
    ?>
  </body>
</html>
