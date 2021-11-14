<?php
// inicio de sesion y configuraciones
session_start();
include "./config/config.php";
include "./config/utils.php";
require_once '../utils/jwt_utils.php';

header("Content-Type: application/json");
date_default_timezone_set("America/Mexico_City");

$dbConn =  connect($db);
// recepcion y validacion  de token previamente creado
$token = get_bearer_token();
$retVal = ($token) ? is_jwt_valid($token) : false ;
// $is_jwt_valid = is_jwt_valid($token);
// $is_jwt_valid =true;

if ($retVal) {
    // validiacion de metodos HTTP usando switch
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            // roles permitdos para metodo get
            if ($_SESSION['rol'] == 'medio' || $_SESSION['rol'] == 'alto medio' || $_SESSION['rol'] == 'alto'){
                // validacion por paramatre
                if (isset($_GET['id'])) {
                    // consulta SELECT con parametro
                    $sql = $dbConn->prepare("SELECT p.title, p.descript, p.created, u.name createdBy, u.rol  FROM publics p INNER JOIN users u ON p.idUser = u.userId where p.publicId=:id AND p.status <> 0");
                    $sql->bindValue(':id', $_GET['id']);
                    $sql->execute();
                    // impresion de datos por parametro
                    echo(json_encode(  $sql->fetch(PDO::FETCH_ASSOC)));
                    header("HTTP/1.1 200 OK");
                    
                    exit();
                } else {
                    //Mostrar lista de publicaciones
                    $sql = $dbConn->prepare("SELECT p.title, p.descript, p.created, u.name createdBy, u.rol FROM publics p INNER JOIN users u ON p.idUser = u.userId WHERE p.status <> 0");
                    $sql->execute();
                    $sql->setFetchMode(PDO::FETCH_ASSOC);

                    // impresion de datos globales
                    print_r(json_encode($sql->fetchAll()));
                    header("HTTP/1.1 200 OK");
                    exit();
                }
            }else{
                // mensaje a usuarios no permitidos
                echo (json_encode(array('error' => 'User Access invalid')));
            }

            break;
        case 'POST':
            // validacion de usuarios
            if ($_SESSION['rol'] == 'medio alto' || $_SESSION['rol'] == 'alto medio' || $_SESSION['rol'] == 'alto'){
                // creacion de variables
                $body=json_decode(file_get_contents("php://input", true), true);
                $d = "Y-m-d";
                // consulta INSERT
                $sql = "INSERT INTO publics
                      (title, descript, status, created, idUser)
                      VALUES
                      (:title, :descript, 1, '". date($d)."','". $_SESSION['id']."' )";
                $statement = $dbConn->prepare($sql);
                bindAllValues($statement, $body);
                $statement->execute();
                $publicId = $dbConn->lastInsertId();
                // verificacion de consulta
                if($publicId)
                {
                    $input['id'] = $publicId;
                    header("HTTP/1.1 200 OK");
                    // print_r(json_encode($body));
                    $array1 = array('success' => 'Public Created');
                    print_r(json_encode(array_merge($body, $array1)));
                    exit();
                }
            }else{
                print_r(json_encode(array('error' => 'User Access invalid')));
            }
            break;
        case 'PUT':
            if ( $_SESSION['rol'] == 'alto medio' || $_SESSION['rol'] == 'alto'){
                $body=json_decode(file_get_contents("php://input", true), true);
                $input = $_GET;
                $publicId = $input['id'];
                $fields = getParams($body);
                $sql = "
                    UPDATE publics
                    SET $fields
                    WHERE publicId='".$publicId."'
                    ";
                $statement = $dbConn->prepare($sql);
                bindAllValues($statement, $body);
                $statement->execute();
                // print_r(json_encode($body));
                print_r(json_encode(array('success' => 'Public Updated')));
                header("HTTP/1.1 200 OK");
                exit();
                        
            }else{
                print_r(json_encode(array('error' => 'User Access invalid')));
            }
            break;
        case 'DELETE':
            // validacion solo de usuario nivel alto
            if ( $_SESSION['rol'] == 'alto'){
                // obtenr ID a eliminar por paramametro
                $id = $_GET['id'];
                $sql = "
                    UPDATE publics
                    SET status=0
                    WHERE publicId='".$id."'
                    ";
                $statement = $dbConn->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                header("HTTP/1.1 200 OK");
                print_r(json_encode(array('success' => 'Public Deleted')));
                exit();
                        
            }else{
                print_r(json_encode(array('error' => 'User Access invalid')));
                
            }
            # code...
            break;
                    
        default:
            # code...
            break;
    }
    


} else {
    print_r(json_encode(array('error' => 'Access denied')));
    header("HTTP/1.1 400 Bad Request");
}

?>
