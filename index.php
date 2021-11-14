<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Prueba Ingeniat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style.css" type="text/css">
    <!-- <style>
        .code{
            font-family: Consolas;
        }
        .tab{
            display: inline;
            padding-left:20px;
            padding-right:20px;
        }
    </style> -->

</head>
<body>
<div  class="container">
    <h1 class="font">Api de Prueba Ingeniat</h1>
    <div class="col">
        <div class="card-group"></div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create User</h3>
            </div>
            <div class="card-body bg-secondary text-white">
                <p class="card-text code">POST <a class="text-white" href="./api/users">/api/users</a></p>
                <p >
                {
                    <div class="tab">
                        "name": "",
                        <br>
                        "app": "",    
                        <br>
                        "email": "",
                        <br>
                        "pass": "",
                        <br>
                        "rol": "" -> (basico, medio, medio alto, alto medio, alto)
                    </div>
                }
                </p>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Login</h3>
            </div>
            <div class="card-body bg-secondary text-white">
                <p class="card-text code">POST <a class="text-white" href="./api/login">/api/login</a></p>
                <p class="card-text">
                {
                    <div class="tab">
                            "email": "",
                        <br>
                            "pass": ""
                    </div>
                }
                </p>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Publics</h3>
            </div>
            <div class="card-body bg-secondary text-white">
                <p class="card-text code">  POST <a class="text-white" href="./api/publics">/api/publics</a></p>
                <p class="card-text">
                {
                    <div class="tab">
                        "title": "",
                        <br>
                        "descript": ""

                    </div>
                }
                </p>
                <span>(Created token)</span>
            </div>
        </div>
        <div class="card mt-3">
            
            <div class="card-body bg-secondary text-white">
                <p class="card-text code">GET <a class="text-white" href="./api/publics">/api/publics</a></p>
                <p class="card-text code">GET <a class="text-white" href="./api/publics?id=0">/api/publics?id=$numeroID</a></p>
            </div>
        </div>
        <div class="card mt-3">
            
            <div class="card-body bg-secondary text-white">
                <p class="card-text code">  PUT <a class="text-white" href="./api/publics">/api/publics</a></p>
                <p class="card-text">
                {
                    <div class="tab">
                        "title": "",
                        <br>
                        "descript": ""

                    </div>
                }
                </p>
                
            </div>
        </div>
        <div class="card mt-3">
            
            <div class="card-body bg-secondary text-white">
                <p class="card-text code">  DELETE <a class="text-white" href="./api/publics?id=0">/api/publics?id=numeroID</a></p>
                
            </div>
        </div>
    </div>
    
</div>

    
</body>
</html>