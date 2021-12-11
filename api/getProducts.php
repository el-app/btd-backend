<?php 
require 'common_services.php';

try {
    $products = $db->getProducts();

    if ($products) {
        produceResult(clearDataArray($products));
    } else {
        produceError("Problème de Récupération des products");
    }

} catch (Exception $th) {
    produceError($th->getMessage());
}

?>