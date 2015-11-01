<?php

require_once("vendor/autoload.php");

$extensions = explode("|","woff|js|jpg|jpeg|gif|css|json|png");
 
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$ext = pathinfo($path, PATHINFO_EXTENSION);

// first find the file , if found, serve
if(in_array($ext, $extensions) && file_exists(realpath('./public').$path)){

    // TODO: possibility to use preprocessor here
    return  false;
}

$app = new Phramework\Core();
$app->run();