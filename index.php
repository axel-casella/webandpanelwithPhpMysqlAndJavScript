<?php

require_once "autoload.php";
require("config/arrays.php");

$seccion = $_GET["secciones"] ?? "inicio";
$auth = new Auth();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Essen | Cocinar hace bien</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/estilos.css">

    <!-- JS-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!--FAVICON-->
    <link rel="shortcut icon" href="iconos/logo.png">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top d-flex">
        <a class="navbar-brand" href="index.php"> Essen  <div class="logo"><img src="imagenes/logo.png" alt="logo Essen 40 años" class="loguito"></div></a>
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0 ml-auto mr-1" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-center ul">
                <?php
                foreach ($navbar as $link => $nombre):
                    if(!$nombre[1]) :
                        continue;
                    endif;
                    ?>
                    <li class="nav-item <?= $link == $seccion ? "active" : ""; ?>">
                        <a class="nav-link" href="index.php?secciones=<?= $link ?>">
                            <?= $nombre[0]; ?>
                        </a>
                    </li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
    </nav>
</header>

<main id="contenido1">

    <?php
    if (array_key_exists($seccion, $navbar))
        require_once("secciones/$seccion.php");
    else
        require_once("secciones/404.php");
    ?>

</main>


<footer id="sticky-footer" class="py-4">
    <div class="container-fluid d-flex float-left align-items-center footer-contenido col-md-2">
        <div class="row">
            <a title="Página principal de Essen Aluminio S.A." href="index.php"><img alt="Essen Aluminio S.A." src="imagenes/logo-blanco.png" class="img-fluid logo-blanco d-inline-block"></a>
        </div>
    </div>
    <div class="container-fluid d-flex float-right align-items-center footer-contenido-2 col-md-2">
        <div class="row">
            <a title="Página principal de Essen Aluminio S.A." href="https://www.essen.com.ar/cont/miembro-de-cavedi-C405/"><img alt="Essen Aluminio S.A." src="imagenes/cavedi-c.png" class="img-fluid logo-blanco d-inline-block"></a>
        </div>
    </div>
    <div class="container text-center">
        <div class="template-demo">
            <a href="https://www.facebook.com/EssenOficial?fref=ts" target="_blank">
                <button type="button" class="btn btn-social-icon btn-facebook btn-rounded">
                    <i class="fa fa-facebook"></i>
                </button>
            </a>
            <a href="https://www.youtube.com/user/Essenoficialvideos" target="_blank">
                <button type="button" class="btn btn-social-icon btn-youtube btn-rounded">
                    <i class="fa fa-youtube"></i>
                </button>
            </a>
            <a href="https://twitter.com/essenoficial" target="_blank">
                <button type="button" class="btn btn-social-icon btn-twitter btn-rounded">
                    <i class="fa fa-twitter"></i>
                </button>
            </a>
            <a href="//instagram.com/essenoficial" target="_blank">
                <button type="button" class="btn btn-social-icon btn-instagram btn-rounded">
                    <i class="fa fa-instagram"></i>
                </button>
            </a>
        </div>
    </div>
</footer>

<!--JS-->
<script src="js/archivo.js"></script>
<script src="js/login.js"></script>


    </body>
</html>