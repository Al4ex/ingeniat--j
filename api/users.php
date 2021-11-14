<?php
// Agregamos los archivos de configuracion y conectamos la DB
include "./config/config.php";
include "./config/utils.php";
$dbConn =  connect($db);
// Generamos el header para retornar json
header("Content-Type: application/json");

//metodo post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // extraccion de datos
    $data= json_decode(file_get_contents("php://input", true), true);
    $email =$data['email'];
    // validacion de correo
    $val = "SELECT * FROM users WHERE email = '$email'";
    $test = $dbConn->prepare($val);
    $a = $test->execute();
    $c = $test->rowCount();
    if ($c != 0) {
        print_r(json_encode(array('error' => 'Email already exist')));
        # code...
    }else{
        //creation new user
        $input = $data;
        $sql = "INSERT INTO users
          (name, app, email, pass, rol)
          VALUES
          (:name, :app, :email, :pass, :rol)";
        $statement = $dbConn->prepare($sql);
        bindAllValues($statement, $input);
        $statement->execute();
        $count = $statement->rowCount();
        // validacion de consulta
        if ($count != 0) {
            $postId = $dbConn->lastInsertId();
            if ($postId) {
                $input['id'] = $postId;
                header('Content-Type: application/json');
                header("HTTP/1.1 200 OK");
                echo json_encode($data);
                exit();
            }
            # code...
        } else {
            header('Content-Type: application/json');
            print_r(json_encode(array('error' => 'Fail query')));
        }
        
    }
    
    
}else{
    header("HTTP/1.1 400 Bad Request");
    print_r(json_encode(array('error' => 'This method not exist')));

}
//En caso de que no se ejecute POST
