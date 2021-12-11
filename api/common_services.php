<?php 
date_default_timezone_set("Europe/Paris");
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding, X-Auth-Token, content-type');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: true');

define("API", dirname(__FILE__));
define("ROOT", dirname(API));
define("SP",DIRECTORY_SEPARATOR);
define("CONFIG", ROOT.SP."config"); 
define("MODEL", ROOT.SP."model");
define("ENTITY", ROOT.SP."entity");
define("API_KEY", 'xxxxxxx');
require CONFIG.SP."config.php";

spl_autoload_register(function($class) {
    if (file_exists(ENTITY.SP.$class.'.php')) {
        require_once ENTITY.SP.$class.'.php';
    } else {
        require_once MODEL.SP.$class.'.class.php';
    }
});

$db = new DataLayer();

function answer($response) {
    global $_REQUEST;
    $response['args'] = $_REQUEST;
    unset($response['args']['password']);
    unset($response['args']['API_KEY']);
    $response['time'] = date('d/m/Y H:i:s');
    echo json_encode($response);
}

function setLastInsertId($id) {
    $_REQUEST['lastInsertId'] = $id;
}

function produceError($message) {
    logMessage($message);
    answer(['status'=>404,'message'=>$message]);
}

function produceErrorAuth() {
    answer(['status'=>401,'message'=>'Authentification requise!']);
}

function produceErrorRequest() {
    logMessage("Requête mal formulée");
    answer(['status'=>400,'message'=>'Requête mal formulée']);
}

function produceResult($result) {
    answer(['status'=>200,'result'=>$result]);
}

function clearData($businessObject) {
    $businessObject = (array)$businessObject;

    $result=[];

    foreach ($businessObject as $key => $value) {
        $result[substr($key,3)]= $value;
    }
    return $result;
}

function clearDataArray($array_bus_obj) {
    $result = [];
    foreach ($array_bus_obj as $key => $value) {
        $result[$key] = clearData($value);
    }
    return $result;
}

function accessControl() {
    global $_REQUEST;
    if (!isset($_REQUEST['API_KEY']) || empty($_REQUEST['API_KEY'])) {
        produceErrorAuth();
        logMessage('Un utilisateur a tenté de se connecter sans clé API');
        exit();
    } elseif ($_REQUEST['API_KEY'] !== API_KEY) {
        produceError("ApI_KEY incorrecte !");
        logMessage('Un utilisateur a tenté une clé API incorrecte');
        exit();
    }
    
}

function logMessage($message) {
    $data = implode($_REQUEST);
    $message = date('d/m/Y H:i:s').' '.$message.PHP_EOL;
    file_put_contents("../log/log.txt", $message, FILE_APPEND | LOCK_EX);
}

accessControl();

?>