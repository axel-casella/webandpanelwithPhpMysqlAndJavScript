/*Casella, Axel Martín*/

var d = document, c = console.log;

//Navbar
        $('.nav-item').on('click', function () {
            $(".navbar-collapse").collapse("hide");
        });

//query SetBásico
        $(document).ready(function () {
            setBasico();
        });

/*INICIO*/

/*Slider inicio*/

(function() {

	function init(item) {
		var items = item.querySelectorAll('li'),
        current = 0,
        autoUpdate = true,
        timeTrans = 4000;
        
		//creo el nav
		var nav = document.createElement('nav');
		nav.className = 'nav_arrows';

		//creo botón prev.
		var prevbtn = document.createElement('button');
		prevbtn.className = 'prev';
		prevbtn.setAttribute('aria-label', 'Prev');

		//creo boton sig.
		var nextbtn = document.createElement('button');
		nextbtn.className = 'next';
		nextbtn.setAttribute('aria-label', 'Next');

		//creo contador
		var counter = document.createElement('div');
		counter.className = 'counter';
		counter.innerHTML = "<span>1</span><span>"+items.length+"</span>";

		if (items.length > 1) {
			nav.appendChild(prevbtn);
			nav.appendChild(counter);
			nav.appendChild(nextbtn);
			item.appendChild(nav);
		}

		items[current].className = "current";
		if (items.length > 1) items[items.length-1].className = "prev_slide";

		var navigate = function(dir) {
			items[current].className = "";

			if (dir === 'right') {
				current = current < items.length-1 ? current + 1 : 0;
			} else {
				current = current > 0 ? current - 1 : items.length-1;
			}

			var	nextCurrent = current < items.length-1 ? current + 1 : 0,
				prevCurrent = current > 0 ? current - 1 : items.length-1;

			items[current].className = "current";
			items[prevCurrent].className = "prev_slide";
			items[nextCurrent].className = "";

			//actualizo contador
			counter.firstChild.textContent = current + 1;
		}
    
    item.addEventListener('mouseenter', function() {
			autoUpdate = false;
		});

		item.addEventListener('mouseleave', function() {
			autoUpdate = true;
		});

		setInterval(function() {
			if (autoUpdate) navigate('right');
		},timeTrans);
    
		prevbtn.addEventListener('click', function() {
			navigate('left');
		});

		nextbtn.addEventListener('click', function() {
			navigate('right');
		});

		//teclas navegador
		document.addEventListener('keydown', function(ev) {
			var keyCode = ev.keyCode || ev.which;
			switch (keyCode) {
				case 37:
					navigate('left');
					break;
				case 39:
					navigate('right');
					break;
			}
		});

		// navegación
		item.addEventListener('touchstart', handleTouchStart, false);        
		item.addEventListener('touchmove', handleTouchMove, false);
		var xDown = null;
		var yDown = null;
		function handleTouchStart(evt) {
			xDown = evt.touches[0].clientX;
			yDown = evt.touches[0].clientY;
		};
		function handleTouchMove(evt) {
			if ( ! xDown || ! yDown ) {
				return;
			}

			var xUp = evt.touches[0].clientX;
			var yUp = evt.touches[0].clientY;

			var xDiff = xDown - xUp;
			var yDiff = yDown - yUp;

			if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*importante*/
				if ( xDiff > 0 ) {
					/* izquierda */
					navigate('right');
				} else {
					navigate('left');
				}
			} 
			/* reseteo valius */
			xDown = null;
			yDown = null;
		};


	}

	[].slice.call(document.querySelectorAll('.cd-slider')).forEach( function(item) {
		init(item);
	});

})();

/*Fin Slider incio*/

// PUBLICIDAD RAMDOM
var imagenespublicidad = [
	{ img: "publi2.jpg", text: "Set Básico 28 cm"},
	{ img: "publi3.jpg", text: "Chef Sensors"},
	{ img: "publi5.jpg", text: "Set Avellana"}
	];

	window.addEventListener("load", function load(){
	var i = Math.floor(Math.random()*imagenespublicidad.length);
	document.getElementById("box").innerHTML = "<img  class='img-fluid' src='imagenes/" + imagenespublicidad[i].img+ "' alt='" + imagenespublicidad[i].text+ "' />";
	},false);

var avisoEssen = d.getElementById('aviso');

const cerrar = d.createElement('a');
cerrar.href = "javascript:void(0)";
cerrar.innerHTML = 'X';

function setBasico() {
    let seleccionado = null;
    d.body.style.overflow = 'hidden';
    window.d.body.appendChild(avisoEssen);
    let tiempo = 10;
    const spanTiempo = d.getElementById('tiempoRestante');

    avisoEssen.appendChild(cerrar);
    cerrar.onclick = function () {
        d.body.style.overflow = 'auto';
        seleccionado = true;
        tiempo = 10;
        clearInterval(restaTiempo);
        spanTiempo.textContent = tiempo;
        avisoEssen.parentNode.removeChild(avisoEssen);
    }

    //Temporizador 
    const restaTiempo = setInterval(function () {
        tiempo--;
        if (tiempo <= 0) {
            tiempo = 10;
            clearInterval(restaTiempo);
            spanTiempo.textContent = tiempo;
        } else {
            spanTiempo.textContent = tiempo;
        }
    }, 1000);

    //Temporizador que se encarga de cerrar la publicidad 
    avisoPublicitario = setTimeout(function () {
        if (seleccionado === null) {
            d.body.style.overflow = 'auto';
            avisoEssen.parentNode.removeChild(avisoEssen);
        }
    }, 10000);
    
window.addEventListener("keyup",function A(e){
	if(e.keyCode==27) {
        document.getElementById("aviso").style.display="none";
			}
		});
	}





