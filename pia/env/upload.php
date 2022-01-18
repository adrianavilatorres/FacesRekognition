<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require 'vendor/autoload.php';


use Dotenv\Dotenv;
use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\Exception\Exception;
use Aws\S3\S3Client;
use Aws\Rekognition\RekognitionClient;



$archivo = $_FILES['archivo'];
$ruta_indexphp = dirname(realpath(__FILE__));
$ruta_fichero_origen = $_FILES['archivo']['tmp_name'];
$ruta_nuevo_destino = $ruta_indexphp . '/originales/' . $_FILES['archivo']['name'];
$ruta_archivo = '/originales/' . $_FILES['archivo']['name'];
$max_tamanyo = 1024 * 1024 * 8; //1MB
$nombre_archivo = $_FILES['archivo']['name'];
$file = $_FILES['archivo']['name'];
$name = $_FILES['archivo']['name'];

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();



if(mime_content_type($archivo['tmp_name']) == "image/jpeg" || mime_content_type($archivo['tmp_name']) == "image/png" || mime_content_type($archivo['tmp_name']) == "image/jpg"){
        
          if($_FILES['archivo']['size']< $max_tamanyo){
               
               if(move_uploaded_file ($ruta_fichero_origen, $ruta_nuevo_destino )){
                    
                    
                    uploadFileToBucket('originales/'. $nombre_archivo, $nombre_archivo);
                    header('Location: https://informatica.ieszaidinvergeles.org:10007/pia/env/show-image.php?file=' . $file . '&name=' . $name);
                    exit;
                    
                   
               }else{
                   header('Location:' . $SERVER['HTTP_REFERER']);
               }
               
                
          }else{
               echo 'Tamaño superado';
          }
     
      
    }else{
        echo 'No es una imagen';
    }


function uploadFileToBucket($file, $key) {
    $result = false;
    try {
        $s3 = new S3Client([
            'version'     => 'latest',
            'region'      => 'us-east-1', //depends on the value of your region
            'credentials' => [
                'key'    => $_ENV['aws_access_key_id'],
                'secret' => $_ENV['aws_secret_access_key'],
                'token'  => $_ENV['aws_session_token']
            ]
        ]);
        $uploader = new MultipartUploader($s3, $file, [
            'bucket' => $_ENV['aws_bucket_name'],
            'key'    => $key,
        ]);
        $result = $uploader->upload();
    } catch(MultipartUploadException $e) {
        $e->getMessage();
    } catch (S3Exception $e) {
        $e->getMessage();
    }
    return $result;
}

