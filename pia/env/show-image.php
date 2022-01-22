<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

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
    <link rel="stylesheet" href="https://unpkg.com/jcrop/dist/jcrop.css">
    <script src="https://unpkg.com/jcrop"></script>
</head>
<body>
    
    <div class="container">
        <div class="imagen">
            <img src="<?= 'originales/' . $file ?>" id="imagen" alt="Imagen subida"></img>
            
        </div>
        
        <form action="pixel-image.php" method='post' id="fblur">
            <input type="hidden" name="name" value="<?= 'originales/' . $file ?>"/>
            <input type="hidden" name="file" value="<?= 'originales/' . $file ?>"/>
            <input type="submit" value="Procesar" name="submit">
        </form>
        <script type="text/javascript" src="service.js"></script>
        
    </div>
    
</body>
</html>



