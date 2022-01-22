<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


$image1 = imagecreatefromjpeg($_POST['file']);
$image2 = imagecreatefromjpeg($_POST['file']);

$salida = $_POST['file'];
$salida = substr($salida, 11);
echo $salida;

for($i = 0; $i < 150; $i++){
    imagefilter($image1, IMG_FILTER_GAUSSIAN_BLUR);
}

foreach($_POST['x'] as $index => $x){
    $y = $_POST['y'][$index];
    $w = $_POST['w'][$index];
    $h = $_POST['h'][$index];
    
    imagecopy($image2, $image1, $x, $y, $x, $y, $w, $h);
};

//imagecopy($image2, $image1, 200, 100, 200, 100, 400, 400); //copy area

imagepng($image2, 'resultado/' . $salida, 0, PNG_NO_FILTER); //save new file

imagedestroy($image1);
imagedestroy($image2);

header('Location: resultado/' . $salida);