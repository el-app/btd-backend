<?php 
require 'common_services.php'; 

if (!isset($_POST["gender"]) || !isset($_POST["pseudo"]) || !isset($_POST["lastname"]) || !isset($_POST["firstname"]) || !isset($_POST["password"])|| !isset($_POST["email"]) || !isset($_POST["birthDate"])) {
    produceErrorRequest();
    return;
}
if(empty($_POST["gender"]) || empty($_POST["pseudo"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["lastname"]) || empty($_POST["firstname"]) || empty($_POST["birthDate"])) {
    produceErrorRequest();
    return;
}

$user = new UserEntity();
$user->setSexe($_POST["gender"]);
$user->setPseudo(($_POST["pseudo"]));
$user->setLastname($_POST["lastname"]);
$user->setFirstname($_POST["firstname"]);
$user->setEmail($_POST["email"]);
$user->setPassword($_POST["password"]);
$user->setDateBirth($_POST["dateBirth"]);

try {
    $data = $db->createUser($user);

    if ($data) {
        setLastInsertId($data);
        produceResult("Compte utilisateur créé avec succès");
    } else {
        produceError("Problème rencontré lors de la création du compte");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>