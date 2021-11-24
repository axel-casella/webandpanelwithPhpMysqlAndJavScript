//PANEL

document.addEventListener('DOMContentLoaded', function(){
    //BUSCO LOS ID
    const msjModal = document.getElementById("msjModal");
    const msjModalCrear = document.getElementById("alerta-panelnv");
    const msjModalEdit = document.getElementById("alerta-paneledit");
    const editProducto = document.getElementById("editar-producto");
    const nvProducto = document.getElementById("nv-producto");
    const msjModalCrearError = document.getElementById("alerta-panelnverror");
    const alertEdit = document.getElementById('alertas-erroredit');
    var loader = document.getElementById("loader");
    //DISPLAYS
    msjModalCrearError.style.display = 'none';
    msjModal.style.display = 'none';
    msjModalCrear.style.display = 'none';
    msjModalEdit.style.display = 'none';
    editProducto.style.display = 'none';
    nvProducto.style.display = 'none';
    alertEdit.style.display = 'none';
    loader.style.display = 'none';

    //FUNCIÓN PRINCIPAL DE LOS PRODUCTOS
    //CREO EL PANEL
    function traerSartenes() {
        panelEssen = document.getElementById('panelEssen');
            fetch('api/switch.php')
                .then(response => response.json())
                .then(panel => {
                    let salida = "";
                    for (let i = 0; i < panel.length; i++) {
                    salida += `<tr>
                                            <td class="text-center"><b>${panel[i].id_producto}</b></td>
                                            <td class="text-center"><img class="img img-fluid" src="${panel[i].imagen}" alt="${panel[i].nombre}"></td>
                                            <td class="text-center">${panel[i].nombre}</td>
                                            <td class="text-center">${panel[i].descripcion}</td>
                                            <td class="text-center">$${panel[i].precio}</td>
                                            <td class="text-center">${panel[i].id_color}</td>
                                            <td class="text-center">${panel[i].id_categoria}</td>
                                            <td class="text-center">
                                                    <div>
                                                         <form action="#" class="editar">
                                                            <input type="hidden"  name="id" value="${panel[i].id_producto}">
                                                            <button type="submit" class="btn btn-warning mt-1">
                                                            <span class="material-icons md-18">
                                                            edit
                                                            </span></button>
                                                        </form>
                                                        <form action="#" class="borrar">
                                                            <input type="hidden"  name="id" value="${panel[i].id_producto}">
                                                            <button type="submit" class="btn btn-danger mt-2">
                                                            <span class="material-icons md-18">
                                                            delete
                                                            </span> </button>
                                                        </form>
                                                    </div>
                                            </td>
                                        </tr>
                                   `;
                }
                panelEssen.innerHTML = salida;
                //BORRAR, CREAR Y EDITAR
                const Borrar = document.getElementsByClassName('borrar');
                const btnCrear = document.getElementById('btn-crear');
                const Editar = document.getElementsByClassName('editar');
                for (let i = 0; i < Editar.length; i++) {
                    Editar[i].addEventListener('click', function (ev) {
                        ev.preventDefault();
                        const idEditar = Editar[i].children[0].value;
                        editarProducto(idEditar);
                    })
                }
                btnCrear.addEventListener('click', function () {
                    nuevoproducto();
                })
                for (let i = 0; i < Borrar.length; i++) {
                    Borrar[i].addEventListener('click', function (ev) {
                        ev.preventDefault();
                        const idProd = Borrar[i].children[0].value;
                        borrarProducto(idProd);
                    })
                }
                
                function editarProducto(idEditar) {
                    const editProducto = document.getElementById("editar-producto");//editBanda
                    const nombreEditar = document.getElementById('nombreedit');
                    const descripcionEditar = document.getElementById('descripcionedit');
                    const precioEditar = document.getElementById('precioedit');
                    const colorEditar = document.getElementById('coloredit');
                    const categoriaEditar = document.getElementById('categoriaedit');
                    const alertaEditar = document.getElementById('alertas-paneledit');//alertasEditar

                    section.style.display = 'none';
                    editProducto.style.display = 'block';
                    alertEdit.style.display = 'none';
                   
                    fetch('api/switch.php?id=' + idEditar)
                        .then(rta => rta.json())
                        .then(response => {
                            for (let i = 0; i < response.length; i++) {
                                nombreEditar.value = response[i].nombre;
                                descripcionEditar.value = response[i].descripcion;
                                precioEditar.value = response[i].precio;
                                colorEditar.value = response[i].color;
                                categoriaEditar.value = response[i].categoria;
                            }
                        });

                    const formEditar = document.getElementById('editarproducto');
                    formEditar.addEventListener('submit', function (ev) {
                        ev.preventDefault();

                        fetch('api/switch.php', {
                            method: 'PUT',
                            body: JSON.stringify({
                                id_producto: idEditar,
                                nombre: nombreEditar.value,
                                descripcion: descripcionEditar.value,
                                precio: precioEditar.value,
                                color: colorEditar.value,
                                categoria: categoriaEditar.value
                            }),
                        })
                            .then(rta => rta.json())
                            .then(response => {
                                if (response.success) {
                                    editProducto.style.display = 'none';
                                    loader.style.display = 'block';
                                    setTimeout(() => {
                                        loader.style.display = 'none';
                                        section.style.display = 'block';
                                        traerSartenes();
                                        msjModalEdit.style.display = 'block';
                                        msjModalEdit.classList.add('alert-succes');
                                        msjModalEdit.children[0].innerHTML = '!El producto a sido editado de manera exitosa!';   
                                        }, 2000);
                                } else {
                                    alertEdit.style.display = 'block';
                                    alertEdit.classList.add('alert-danger');
                                    let r = '<ul>';
                                    for (let property in response.error) {
                                        r += '<li>' + response.error[property] + '</li>';
                                    }
                                    r += '</ul>';
                                    alertEdit.innerHTML = r;
                                }

                            });
                    });

                }
                function borrarProducto(idProd) {
                    fetch('api/switch.php', {
                        method: 'DELETE',
                        body: JSON.stringify({
                        id: idProd
                        })
                    })
                        .then(rta => rta.json())
                        .then(response => {
                            if (response.success) {
                                traerSartenes();
                                msjModal.style.display = 'none';
                                msjModal.classList.add('alert-error');
                                msjModal.children[0].innerHTML = 'Algo a salido mal. Por favor intentelo nuevamente';
                            } else {
                                    const section = document.getElementById('section');    
                                    section.style.display = 'none';
                                    loader.style.display = 'block';
                                    setTimeout(() => {
                                    loader.style.display = 'none';
                                    section.style.display = 'block';
                                    traerSartenes();
                                    msjModal.style.display = 'block';
                                    msjModal.classList.add('alert-succes');
                                    msjModal.children[0].innerHTML = '!El producto a sido borrado de manera exitosa!';   
                                    }, 2000);
                            }
                        });
                    }
                    function nuevoproducto(){
                        const formCrearProducto = document.getElementById('nv-producto');
                        const section = document.getElementById('section');    
                        section.style.display = 'none';
                        formCrearProducto.style.display = 'block';
                        const idImagenCrear = document.getElementById('imagenCrear');
                        let imagen;
                        idImagenCrear.addEventListener('change', function (ev) {
                            ev.preventDefault();
                            const reader = new FileReader;
    
                            reader.addEventListener('load', function () {
                                imagen = reader.result;
    
                                respuesta.innerHTML = ` <img src="${imagen}" id="imagen" class"img-fluid rounded" alt="Imagen previsualizada">
                                                         <figcaption class="figure-caption text-center">Previsualización de la imagen</figcaption>`;
                            });
    
                            reader.readAsDataURL(this.files[0]);
                        });
                    formCrearProducto.addEventListener('submit', function (ev) {
                        ev.preventDefault();
                        fetch('actions/crear.php', {
                            method: 'POST',
                            body: JSON.stringify({
                                id_producto: id_producto.value,
                                nombre: nombre.value,
                                descripcion: descripcion.value,
                                precio: precio.value,
                                id_color: color.value,
                                id_categoria: categoria.value,
                                imagen: imagen
                            }),
                        })
                            .then(rta => rta.json())
                            .then(response => {
                                if (response.success) {
                                    const formCrearProducto = document.getElementById('nv-producto');
                                    formCrearProducto.style.display = 'none';
                                    
                                    loader.style.display = 'block';
                                    setTimeout(() => {
                                        loader.style.display = 'none';
                                        section.style.display = 'block';
                                        traerSartenes();
                                        limpiarFormCrear();
                                        msjModalCrear.style.display = 'block';
                                        msjModalCrear.classList.add('alert-succes');
                                        msjModalCrear.children[0].innerHTML = '!El producto a sido creado de manera exitosa!';   
                                        }, 2000);
                                } else {
                                    msjModalCrearError.style.display = 'block';
                                    msjModalCrearError.classList.add('alert-danger');
                                    let r = '<ul>';
                                    for (let property in response.error) {
                                        r += '<li>' + response.error[property] + '</li>';
                                    }
                                    r += '</ul>';
                                    msjModalCrearError.innerHTML = r;
                                }
                                
                            });
                            
                         })
                    }
                    
                })
                
            }
            traerSartenes();
            function limpiarFormCrear() {
                id_producto.value = '';
                nombre.value = '';
                descripcion.value = '';
                precio.value = '';
                color.value = '';
                categoria.value = '';
                imagen = '';
            }
    })
 
            
    

    