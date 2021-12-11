<?php 
require 'common_services.php';

try {
    $orders = $db->getOrders();

    if ($orders) {
        produceResult(clearDataArray($orders));
    } else {
        produceError("Problème de Récupération des commandes");
    }

} catch (Exception $th) {
    produceError($th->getMessage());
}

?>