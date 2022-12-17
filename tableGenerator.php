<?php 

class TableGenerator {
  public static function generateTable($parameters) {
    // Génération de la table HTML à partir des paramètres
    $tableHTML = '<table>';
    // ... génération du contenu de la table ici ...
    $tableHTML .= '</table>';
 
    // Génération de la div qui contiendra la table
    $divHTML = '<div>';
    $divHTML .= $tableHTML;
    $divHTML .= '</div>';
 
    return $divHTML;
  }
}

?>