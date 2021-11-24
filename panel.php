<?php

require("config/arrays.php");
require_once "autoload.php";



if(!isset($_SESSION['id'])){
    header("Location:index.php");
    exit;
}

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>

<body>
<header class="bg-image-none h-auto">
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top d-flex">
        <a href="#" class="navbar-brand">
            <img src="imagenes/logo.png" alt="logo Essen 40 años" width="100">
        </a>
        <b><span style="font-size:10px">¡Bienvenido! <?= $auth->getUser()->getEmail();?></span></b>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                 aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item">
                    <a class="nav-link active <?= $auth->isAuthenticated(); ?>" href="panel.php">
                    <i class="material-icons">
                    <span class="material-icons-outlined">
                    admin_panel_settings
                    </span>
                    </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="logout">
                    <span class="material-icons">
                    logout
                    </span> 
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

    <div id="loader" class="container mt-5">
        <div class="row justify-content-center">
            <div class="text-dark mt-5">
                <b><span>Guardando cambios...</span></b>   
            </div>
        </div>
    </div>


<section id="section" class="container">
    <div class="estilo-login">
        <h2 class="p-3 text-center mt-5"><u>Panel de control</u></h2>
    </div>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" id="msjModal">
        <b><span></span></b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" id="alerta-panelnv">
        <b><span></span></b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
    </div>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" id="alerta-paneledit">
        <b><span></span></b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
             </button>
    </div>
    <div class="row my-4">
        <article id="ocultartmb" class="col-12">
            <div class="card" id="panel">
                <div class="card-header">
                    <h2 class="h4 text-warning card-title">Essen <span class="text-black-50 fs-90">Listado de producto</span></h2>
                </div>
                <div class="card-body">
                    <button id='btn-crear' type="button"
                            class="btn btn-sm btn-warning float-right my-2 rounded-circle btn-a"><b class="btn-agr" title="Agregar nuevo prodructo">+</b></button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm fs-90">
                            <thead class="thead-light text-center">
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Color</th>
                                <th>Categoría</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody id="panelEssen">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </article>
        </div>
</section>

<article class="container-fluid mt-2" id="nv-producto">
            <div class="row justify-content-center">
                <h3 class="mt-2 text-center col-12">Crear un nuevo producto</h3>
                <div class="alert alert-success alert-dismissible fade show col-8 text-center" role="alert" id="alerta-panelnverror">
                    <b><span></span></b>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                </div>
                <form action="#" id="subirProducto" class="col-8">
                    <div class="form-group col-12">
                        <label for="nombre">ID</label>
                    <input placeholder="" type="text" id="id_producto" name="id_producto" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label for="nombre">Nombre</label>
                        <input placeholder="Cacerola 18cm" type="text" id="nombre" name="nombre" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label  for="descripcion">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="descripcion"
                                  cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label for="nombre">Precio</label>
                        <input type="number" class="form-control" step=".1" min="0.1" id="precio"
                               placeholder="$10000.00" name="precio">
                    </div>
                    <div class="form-group col-12">
                        <label for="color">Color</label>
                        <select name="color" id="color" class="form-control">
                        <option value="1">Aqua</option>
                        <option value="2">Terra</option>
                        <option value="3">Marsala</option>
                        </select>           
                    </div>
                    <div class="form-group col-12">
                        <label for="categoria">Categoría</label>
                        <select name="categoria" id="categoria" class="form-control">
                        <option value="1">Cacerola</option>
                        <option value="2">Sartén</option>
                        <option value="3">Bifera</option>
                        </select>
                    </div>
                <div class="form-group col-6">
                <figure class="card shadow border" id="respuesta">
                </figure>
                <div>
                    <label for="imagenCrear">Imagen</label>
                    <input type="file" accept="image/jpeg,image/png" id="imagenCrear" name="imagen" required>
                    <small id="fileHelpId" class="form-text text-muted">El formato de la imagen debe ser
                        <b>JPG o PNG</b></small>
                </div>
            </div>
            <div class="text-center col-12 mt-5">
                <button class="btn btn-1 m-auto px-4" type="submit">Crear producto</button>
            </div>
                </form>
                <div class="col-12 row">
                    <div id="loader" class="col-2 m-auto">

                    </div>
                </div>
            </div>
        </article>

        <article class="container-fluid mt-2" id="editar-producto">
            <div class="row justify-content-center estilo-productos">
                <h3 class="mt-2 text-center col-12 mt-5 mb-5">Editar un producto</h3>
                <div class="alert alert-success alert-dismissible fade show col-8 text-center" role="alert" id="alertas-erroredit">
                    <b><span></span></b>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                </div>
                <form action="#" id="editarproducto" class="col-8">
                    <div class="form-group col-12">
                        <label for="nombre">Nombre</label>
                        <input  type="text" id="nombreedit" name="nombre" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label  for="descripcion">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="descripcionedit"
                                  cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label for="precio">Precio</label>
                        <input id="precioedit" type="number" class="form-control" step=".1" min="0.1"
                               name="precio">
                    </div>
                    <div class="form-group col-12">
                        <label for="color">Color</label>
                        <select name="color" id="coloredit" class="form-control">
                        <option value="1">Aqua</option>
                        <option value="2">Terra</option>
                        <option value="3">Marsala</option>
                        </select>           
                    </div>
                    <div class="form-group col-12">
                        <label for="categoria">Categoría</label>
                        <select name="categoria" id="categoriaedit" class="form-control">
                        <option value="1">Cacerola</option>
                        <option value="2">Sartén</option>
                        <option value="3">Bifera</option>
                        </select>
                    </div>
                <div class="text-center col-12 mt-5">
                        <button class="btn btn-1 m-auto px-4" type="submit">Editar producto</button>
                    </div>
                </form>
                <div class="col-12 row">
                    <div id="loader" class="col-2 m-auto">

                    </div>
                </div>
            </div>
        </article>
<script src="js/logout.js"></script>
<script src="js/panel.js"></script>

    </body>
</html>