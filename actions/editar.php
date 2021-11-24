<?php
require_once '../autoload.php';


if(!isset($_SESSION['id'])){
    json_encode([
        'authorized' => -1,
        'mensaje' => 'Se requiere haberse logueado para realizar cambios en el panel'
    ]);
    exit;
}    

header("Content-Type:application/json");
$inputData = file_get_contents('php://input');
$postData = json_decode($inputData,true);
$id_producto = $postData['id_producto'];
$nombre = $postData['nombre'];
$descripcion = $postData['descripcion'];
$precio = $postData['precio'];
$color = $postData['color'];
$categoria = $postData['categoria'];


$validator = new Validator($postData, Cacerolas::$reglasCacerolas2);

if(!$validator->passes()){
    echo json_encode([
        'success' => false,
        'error' => $validator->getErrores(),
    ]);
    exit;
}

    $cacerola = new Cacerolas();

        $exito = $cacerola->editarSarten([
        'id_producto' => $id_producto,
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'precio' => $precio,
        'color' => $color,
        'categoria' => $categoria
    ]);

   
    if($exito) {
        echo json_encode([
            'success' => true,
        ]);
    }else{
        echo json_encode([
            'success' => false,
            'error' => 'Error inesperado en la base de datos'
        ]);
    }
