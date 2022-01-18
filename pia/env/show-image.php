<?php

if(isset($_GET['file']) && isset($_GET['name'])){
    $file = $_GET['file'];
    $name = $_GET['name'];
    
}else{
    echo 'Hay un error';
    //exit;
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekognition</title>
</head>
<body>
    
    <div class="container">
        <div class="imagen">
            <img src="<?= 'originales/' . $file ?>" alt="Imagen subida" width="70%"></img>
            <script type="text/javascript" src="service.js"></script>
        </div>
    </div>
    
    
</body>
</html>



