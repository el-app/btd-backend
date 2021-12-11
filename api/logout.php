<?php
session_start();
require 'common_services.php';

if (isset($_SESSION['ident'])) {
    unset($_SESSION['ident']);
    session_destroy();
    produceResult("User logged out successfully");
    return;
} else {
    produceError("User is not logged in");
}

?>
