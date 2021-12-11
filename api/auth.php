<?php 
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
};
require 'common_services.php';

// If user is already authenticated
if(session_status() == PHP_SESSION_ACTIVE) {
    produceError("Utilisateur déjà connecté");
    return;
}

// If request is badly written
if(!isset($_POST['email']) || !isset($_POST['password'])){
    ProduceErrorRequest();
    return;
}

try {
    $user = new UserEntity();
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    
    $dataAuth = $db->authenticate($user);

    if($dataAuth){
        // Successful authentication
        $_SESSION['ident']=$dataAuth;
        produceResult(clearData($dataAuth));
    }else {
        // Failed authentication
        produceError("Email ou mot de passe incorrect. Merci de réessayer !");
    }

} catch (Exception $th) {
    produceError($th->getMessage());
}

?>