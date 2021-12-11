<?php 
require 'common_services.php';

try {
    $categories = $db->getCategories();

    if ($categories) {
        produceResult(clearDataArray($categories));
    } else {
        produceError("Problème de Récupération des catégories");
    }

} catch (Exception $th) {
    produceError($th->getMessage());
}

?>