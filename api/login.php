<?php 
// Agregamos los archivos de configuracion y conectamos la DB
    include "./config/config.php";
    include "./config/utils.php";
    $dbConn =  connect($db);
    // usar libreria JWT
    require_once '../utils/jwt_utils.php';

    header("Content-Type: application/json");

    // obtener datos por el metodo POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // atrapar datos
        $data = json_decode(file_get_contents("php://input", true));
        // consultar el ususrio en la BD
        $sql = $dbConn->prepare("SELECT * FROM users WHERE email = '" . $data->email . "' AND pass = '" . $data->pass . "' LIMIT 1");
        $sql->execute();
        $count = $sql->rowCount();
        
        if($count < 1) {
            echo json_encode(array('error' => 'Invalid User'));
            // header("HTTP/1.1 400 Bad Request");
        } else {
            // obtener valores de la consulta anterior
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $email = $row['email'];
            // generar una sesion para atrapar datos del usuario
            session_start();
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['id'] = $row['userId'];
            // crecaion de variables para generar token
            $headers = array('alg'=>'HS256','typ'=>'JWT');
            $payload = array('email'=>$email, 'exp'=>(time() + 300));
            // generar y mostrar token
            $jwt = generate_jwt($headers, $payload);
            print_r( json_encode(array('token' => $jwt)));
            header("HTTP/1.1 200 OK");
        }
    }
    else{
        //En caso de que no se ejecute POST
        header("HTTP/1.1 200 OK");
        print_r(json_encode(array('error' => 'This method not exist')));
    }

?>