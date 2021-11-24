//LOGIN

document.addEventListener('DOMContentLoaded', function(){
    
    const inputemail = document.getElementById('inputEmail');
    const inputpassword = document.getElementById('inputPassword');
    const uploadUser = document.getElementById('uploader');
    const alertaModal = document.getElementById('alertas-modal');

    alertaModal.style.display = 'none';
    
    uploadUser.addEventListener("submit", function(ev){
        ev.preventDefault();
        fetch('api/switch.php',{
            method:'POST',
            body: JSON.stringify({
                email: inputemail.value,
                password: inputpassword.value
            })
        })
            .then(rta => rta.json())
            .then(response =>{
                if (response.exito){
            location.href = 'panel.php';
                }
                else{
                    alertaModal.style.display = 'block';
                    alertaModal.classList.remove('alert-success');
                    alertaModal.classList.add('alert-danger');
                    alertaModal.children[0].innerHTML = '!Usuario y/o contraseña incorrectos! Ingrese las credenciales nuevamente.';
                    setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        })
    })

})