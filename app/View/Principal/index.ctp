<?php echo $this->Html->script('lightbox.min.js') ?>
<?php echo $this->Html->css('lightbox.min.css') ?>
<!-- Iconos para cambiar el tipo de vista -->
<div class="right-align">
	<a id="mostrarMosaico" class="active"><i class="fa fa-th-large"></i></a>
	<a id="mostrarCarousel"><i class="fa fa-picture-o"></i></a>
</div>
<!-- Termina iconos para cambiar el tipo de vista -->
<div id="vistaMosaico">
	<div id="contenedorImagenes" class="center-align row"></div>
	<!-- Mensaje para indicar el procesamiento de datos-->
	<div class="center-align" id="loader" hidden>
	   <div class="progress">
	      <div class="indeterminate"></div>
	   </div>
	</div>
	<!-- Termina mensaje para indicar el procesamiento de datos-->
	<div class="row">
	   <div class="center-align">
	      <button id="botonCargar" class="btn btnd">Ver más</button>
	   </div>
	</div>
	<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
</div>
<div id="vistaCarousel" hidden>
	<div id="contenedorCarousel" class="carousel"></div>
</div>
<script type="text/javascript">
	//Variables globales
	var vistaMosaico = $('#vistaMosaico');
	var vistaCarousel = $('#vistaCarousel');
	var mostrarMosaico = $('#mostrarMosaico');
	var mostrarCarousel = $('#mostrarCarousel');
	var carousel = $('#contenedorCarousel');
	var contenedorImagenes = $("#contenedorImagenes");
	var contenedorCarousel = $("#contenedorCarousel");
	var imagenesIniciales = <?php echo $data ?>;
	var botonCargar = $('#botonCargar');
	var loader = $("#loader");
	//Variable que indica el número de imágenes a traer dinámicamente para la vista mosaico
	var offset = 0;
	//Variable que indica el número de imágenes a traer dinámicamente para la vista carousel
	var offsetCarousel = 0;
	var contadorCarousel = 0;
	//Generamos un template para las imágenes con lightbox
	var template = '<a href="<?php echo Router::url('/', true)?>{index}" data-lightbox="mosaico" data-title="{nombre}">';
	template += '<img class="responsive-img img-mosaico" alt="Cargando Gif" src="<?php echo Router::url('/', true)?>{index}" style="height:200px; left:-10px;">';
	template += '</a>';
	var templateCarousel = '<a onclick="cargarImagenesCarousel(this.id)" class="carousel-item" id="{id}"><img src="{urlImagen}"></a>';
	var html = '';
	//Generamos un contenedor para el template
	var contenedorTemplate = '<div class="col s12 m3"><div class="card"><div class="card-image">{template}</div><div class="card-action"><span>{numLikes}</span> Me gusta <i onclick="darLike({imagenId}, this);" class="fa fa-thumbs-up iconoImagen" aria-hidden="true"></i> {descargarImagen} <div>{social}</div></div></div></div>';
	//Generamos el template para los botones de compartir
	var comTwitter = '<a class="btnz share twitter" onclick="mostrarCompartirTwitter(\'{urlImagen}\');">Compartir <i class="fa fa-twitter" aria-hidden="true"></i></a>';
	//Generamos botón para descargar la imagen
	var btnDescargar = '<a href="{urlImagen}" class="iconoImagen" download><i class="fa fa-download" aria-hidden="true"></i></a>';
	//Mostramos las primeras imágenes enviadas por el controlador
	performMostrarImagenes(imagenesIniciales);
	var primeraCarga = true;
	//Agregamos el fondo de pantalla animado
	$('body').css('background-image', 'url(<?php echo Router::url('/', true)?>img/fondo-inicio.gif), url(<?php echo Router::url('/', true)?>img/fondo-inicio.gif)');

	//Agregamos el evento que carga más imágenes
    botonCargar.on('click', function() {
    	offset += <?php echo NUM_IMAGENES ?>;
    	$.ajax({
    		url: '<?php echo $this->Html->url(["controller" => "principal","action" => "index"]); ?>',
    		type: 'POST',
    		data: {offset: offset},
	        beforeSend: function( xhr ) {
	            //Mostramos mensaje de envío cuando se procese los datos
	           loader.show();
	        },
	        success: function(data, textStatus, request) {
	        	imagenes = $.parseJSON(data);
	        	if (imagenes.length > 0) {
	        		performMostrarImagenes(imagenes);
	        	} else {
	        		Materialize.toast('Has visto todas las imágenes disponibles :(', 3000, 'mensaje-alerta');
	        	}
            	//Ocultamos el mensaje de envío de datos
            	loader.hide();
	        }
    	});
    });

    //Mostramos la vista de mosaico al dar clic en el botón
	mostrarMosaico.on('click', function (e){
		vistaCarousel.hide();
    	vistaMosaico.show('fast');
    	mostrarMosaico.addClass('active');
    	mostrarCarousel.removeClass('active');
    });

	//Mostramos la vista de carousel al dar clic en el botón
	mostrarCarousel.on('click', function (e){
    	vistaMosaico.hide('fast');
    	vistaCarousel.show('fast');
    	if (primeraCarga) {
    		primeraCarga = false;
    		//Cargamos las imágenes de carousel
			cargarCarousel(offset, 1);
			offsetCarousel += <?php echo NUM_IMAGENES ?>;
    	}
    	mostrarCarousel.addClass('active');
    	mostrarMosaico.removeClass('active');
    });

	/**
	* Función que genera la vista carousel
	* 
	* @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
	* @param int id Id del tag que contiene a la imagen
	*/
	function cargarImagenesCarousel(id){
		var idImagen = id.replace("imagen","");
		//Cargamos más imágenes cuando el usuario toca la última imagen
		if(contadorCarousel==idImagen){
			offsetCarousel += <?php echo NUM_IMAGENES ?>;
			cargarCarousel(offsetCarousel, idImagen);
		}
	}

	/**
	* Función que carga más datos para la vista carousel
	* 
	* @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
	* @param int offset Offset para la petición de datos
	* @param int posicionImagen número para indicar en que posición debemos iniciar el carousel
	*/
	function cargarCarousel(offset, posicionImagen){
		$.ajax({
    		url: '<?php echo $this->Html->url(["controller" => "principal","action" => "index"]); ?>',
    		type: 'POST',
    		data: {offset: offset},
	        beforeSend: function( xhr ) {
	            //Mostramos mensaje de envío cuando se procese los datos
	           loader.show();
	        },
	        success: function(data, textStatus, request) {
	        	imagenes = $.parseJSON(data);
	        	if (imagenes.length > 0) {
	        		performMostrarImagenesCarousel(imagenes, posicionImagen);
	        	} else {
	        		Materialize.toast('Has visto todas las imágenes disponibles :(', 3000, 'mensaje-alerta');
	        	}
            	//Ocultamos el mensaje de envío de datos
            	loader.hide();
	        }
    	});
	}

	/**
	* Función que genera la vista mosaico de un arreglo de imágenes
	* 
	* @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
	* @param Array imagenes Arreglo con las imágenes que se desean agregar a la vista
	* @return void
	*/
	function performMostrarImagenes(imagenes){
		html = contenedorImagenes.html();
		$.each(imagenes, function(index, imagen) {
			tagTemplate = template.replace(/\{index}/g, imagen.Gif.img_ruta).replace('{nombre}', imagen.Gif.img_nombre);
			urlImagen = '<?php echo Router::url('/', true)?>'+imagen.Gif.img_ruta;
			tagDescargarImagen = btnDescargar.replace('{urlImagen}', urlImagen);
			html += contenedorTemplate.replace('{template}', tagTemplate).replace('{social}', comTwitter.replace('{urlImagen}', urlImagen)).replace('{descargarImagen}', tagDescargarImagen).replace('{numLikes}', imagen.Like.length).replace('{imagenId}', imagen.Gif.imagen_id);
		});
		contenedorImagenes.html(html);
	}

	/**
	* Función que permite dar like a una imagen
	* 
	* @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
	* @param int imagenId id de la imagen a la que se le dará el like
	* @param element botonLike elemento del DOM al que se le está dando el clic, lo usamos para actualizar el núm de likes
	* @return void
	*/
    function darLike(imagenId, botonLike) {
    	$.ajax({
    		url: '<?php echo $this->Html->url(["controller" => "principal","action" => "darLike"]); ?>/'+imagenId,
    		type: 'GET',
	        success: function(data, textStatus, request) {
	        	like = request.getResponseHeader('like');
	        	faltaSesion = request.getResponseHeader('faltaSesion');
	        	numLikes = request.getResponseHeader('numLikes');
	        	if (like == true) {
	        		$(botonLike).prev().html(numLikes);
	        	}else if (like == 'already') {
	        		Materialize.toast('Ya has dado me gusta a esta imagen', 3000, 'mensaje-alerta');
	        	}
	        	if (faltaSesion == true) {
	        		Materialize.toast('Inicia sesión para dar me gusta', 3000, 'mensaje-alerta');	
	        	}
	        }
    	});
    }

	/**
	* Función que genera la vista carousel de un arreglo de imágenes
	* 
	* @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
	* @param Array imagenes Arreglo con las imágenes que se desean agregar a la vista
	* @param int posicionImagen número para indicar en que posición debemos iniciar el carousel
	*/
	function performMostrarImagenesCarousel(imagenes, posicionImagen){
		html = contenedorCarousel.html();
		$.each(imagenes, function(index, imagen) {
			contadorCarousel++;
			urlImagen = '<?php echo Router::url('/', true)?>'+imagen.Gif.img_ruta;
			html += templateCarousel.replace('{id}', 'imagen'+contadorCarousel).replace('{urlImagen}', urlImagen);
		});
		//Si el carusel ya estaba creado, lo desinicializamos para evitar errores
		if (carousel.hasClass('initialized')) {
			carousel.removeClass('initialized');
		
		}
		contenedorCarousel.html(html);
		carousel.carousel();
		carousel.carousel('set', posicionImagen);
	}

	//Configuramos el lightbox
	lightbox.option({
      'resizeDuration': 100,
      'alwaysShowNavOnTouchDevices': true,
      'albumLabel': 'Imagen %1 de %2',
    });

    //Mostramos el compartir de twitter
    function mostrarCompartirTwitter(urlImagen){
    	url = 'https://twitter.com/intent/tweet?hashtags=giffer&text=';
    	url += encodeURIComponent('¡Giffer es super cool!')+'&url=';
    	url += encodeURIComponent(urlImagen);
    	popupCenter(url, 'Giffer', 600, 400);
    }

    //Función que abre una nueva ventana en el centro del navegador
	function popupCenter(url, title, w, h) {
	    // Fixes dual-screen position                         Most browsers      Firefox
	    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
	    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

	    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
	    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

	    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
	    var top = ((height / 2) - (h / 2)) + dualScreenTop;
	    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

	    // Puts focus on the newWindow
	    if (window.focus) {
	        newWindow.focus();
	    }
	}

	// Activamos el botón para ir arriba
	$(window).scroll(function() {
	    if ($(this).scrollTop() >= 50) {        
	        $('#return-to-top').fadeIn(200);    
	    } else {
	        $('#return-to-top').fadeOut(200);   
	    }
	});
	$('#return-to-top').click(function() {      
	    $('body,html').animate({
	        scrollTop : 0                       
	    }, 500);
	});
</script>

