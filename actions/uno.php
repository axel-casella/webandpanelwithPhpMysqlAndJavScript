<?php
require_once '../autoload.php';


if(!isset($_SESSION['id'])){
    json_encode([
        'authorized' => -1,
        'mensaje' => 'Se requiere haberse logueado para realizar cambios en el panel'
    ]);
    exit;
}    

$id_producto = $_GET['id'];
$cacerolas = new Cacerolas();
$unaCacerola = $cacerolas->traerUnSarten($id_producto);
echo json_encode($unaCacerola);

