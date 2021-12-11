<?php
require 'common_services.php';

if (!isset($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
    produceErrorRequest();
    return;
}

$order = new OrderEntity();
$order->setIdOrder($_REQUEST["id"]);

try {
    $data = $db->deleteOrder($order);

    if ($data) {
        produceResult('Suppression réussie ;');
    } else {
        produceError("Echec de la suppression. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}