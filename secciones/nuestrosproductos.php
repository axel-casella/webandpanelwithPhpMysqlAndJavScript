<?php

$cacerolas = new cacerolas;
$allCacerolas = $cacerolas->traerSartenes();

?>

<section class="estilo-productos container">
            <div class="row m-0">
                <div class="col-12 mb-5">
                    <div class="content-header" data-component-initialized="true">
                        <div class="content-header__image">
                            <picture class="pic_portada">
                                <img src="imagenes/cace.png" alt="portada" title="" class="img_portada">
                            </picture>
                                <div class="content-header__body">
                                    <h1 class="content-header__title text-center">Dale versatilidad a tu cocina</h1>
                                </div>
                        </div>
                    </div>
                </div>
                <article class="row justify-content-center">
                    <div class="col-12 text-center mb-5 mt-5">
                        <p>
                            Con el tiempo, la línea de productos Essen se multiplicó e incorporó nuevos y únicos diseños y técnicas. La pequeña fundición se transformó en la fábrica de cacerolas de aluminio fundido más grande del mundo con tecnología de última generación.
                        </p>
                    </div>
                </article>
                    <div class="row mt-5 mb-5">
                        <?php
                        foreach($allCacerolas as $cacerolas):
                        ?>
                        <div class="col-md-6 my-3">
                            <div class="news">
                                <div class="img-figure">
                                        <img class="img-fluid" src="<?=$cacerolas->getImagen();?>" alt="<?=$cacerolas->getNombre();?>">
                                </div>
                                <div class="title">
                                    <h1><?=$cacerolas->getNombre();?></h1>
                                </div>
                                <p class="description">
                                    <?=$cacerolas->getDescripicion();?>
                                </p>
                                <ul class="description">
                                    <li class="mt-2"><b class="text-naranja">ID: </b><?=$cacerolas->getIdProducto();?></li>
                                    <li class="mt-2"><b class="text-naranja">Precio: </b>$<?=$cacerolas->getPrecio();?></li>
                                    <li class="mt-2"><b class="text-naranja">Color: </b><?=$cacerolas->getColor();?></li>
                                    <li class="mt-2"><b class="text-naranja">Tipo: </b><?=$cacerolas->getCategoria();?></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
            </div>
</section>




