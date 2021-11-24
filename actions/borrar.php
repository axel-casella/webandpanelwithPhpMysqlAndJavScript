<?php
require_once '../autoload.php';

if(!isset($_SESSION['id'])){
    json_encode([
        'authorized' => -1,
        'mensaje' => 'Se requiere haberse logueado para realizar cambios en el panel'
    ]);
}

header("Content-Type:application/json");
$input = file_get_contents('php://input');
$postData = json_decode($input,true);
echo json_encode($postData);
$id = $postData['id'];
$cacerola = new Cacerolas;
$borrandoCacerola = $cacerola->borrarProducto($id);

