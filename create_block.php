<?php
function createBlock($conn, $submodule) {
    // Récupère l'ID du module actuel
    $moduleQuery = "SELECT id FROM modules WHERE name = '$submodule'";
    $moduleResult = mysqli_query($conn, $moduleQuery);
    $moduleRow = mysqli_fetch_assoc($moduleResult);
    $moduleId = $moduleRow['id'];

    // Requête pour récupérer les sous-modules liés au module de la page actuelle
    $query = "SELECT submodules.* FROM submodules
              INNER JOIN module_submodules ON submodules.id = module_submodules.submodule_id
              WHERE module_submodules.module_id = '$moduleId'";
              
    // Exécute la requête
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        // Affichage de chaque bloc
        while ($submodule_data = $result->fetch_assoc()) {
            
            // Génération du HTML du bloc avec le style ajouté
            $block = '<div class="col-sm-' .  $submodule_data['largeur'] . ' p-3 mb-2 bg-dark shadow mx-auto">';
            $block .= '<h5 class="text-light">' . $submodule_data['name'] . '</h5>';
            $block .= '<div class="text-light" id="submodule-' . $submodule_data['name'] . '"></div>';
            $block .= '</div>';
            
            echo $block;
        }
    }
}
