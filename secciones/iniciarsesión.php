<?php

if(isset($_SESSION['id'])){
    header("Location:panel.php");
    exit;
}

$auth = new Auth();

?>

<section id="section" class="estilo-login">
    <div class="bg-login">
        <div class="row m-0 justify-content-center">
            <div class="col-auto">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container mt-5 mb-2">
                            <img src="iconos/usuario.png"
                                 class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" id="alertas-modal">
                        <b><span></span></b>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <form id="uploader" action="" method="">
                            <div class="input-group mb-3">
                                <div class="input-group-append">

                                </div>
                                <input  id="inputEmail" type="text" name="usuario" class="form-control input_user mt-3"
                                       placeholder="usuario">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">

                                </div>
                                <input id="inputPassword" type="password" name="password" class="form-control input_pass"
                                       placeholder="***********">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Recordarme</label>
                                </div>
                            </div>
                            <?php if(!$auth->isAuthenticated()):?>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="button" class="btn login_btn btn-log">Ingresar</button>
                            </div>
                            <?php endif;?>
                        </form>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            ¿No tenes usuario? <a href="#" class="ml-2">Registrate</a>
                        </div>
                        <div class="d-flex justify-content-center links mb-5">
                            <a href="#">¿Olvidaste tu clave?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>