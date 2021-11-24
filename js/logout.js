//LOGOUT

document.addEventListener('DOMContentLoaded', function(){
    const logout = document.getElementById("logout");

    logout.addEventListener('click',function(){
    fetch('actions/logout.php', {
        method: 'POST',
    })
        .then(response => {
            location.href = 'index.php';
        })         
    })
})