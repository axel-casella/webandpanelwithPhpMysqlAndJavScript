<?php
require_once '../autoload.php';

if(!isset($_SESSION['id'])){
    json_encode([
        'authorized' => -1,
        'mensaje' => 'Se requiere haberse logueado para realizar cambios en el panel'
    ]);
    exit;
}    

$auth = new Auth;
$auth->logout();

