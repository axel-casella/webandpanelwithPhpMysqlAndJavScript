<?php
require '../autoload.php';
header("Content-Type: application/json");
$db = DBConnection::getConnection();


switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])){
            include '../actions/uno.php';
        }else{
            include '../actions/todos.php';
        }
        break;
    case 'POST':
        include '../actions/login.php';
        break;
    case 'PUT':
        include '../actions/editar.php';
        break;
    case 'DELETE':
        include '../actions/borrar.php';
        break;
}
