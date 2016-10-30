<?php echo $this->Html->script('datatables.min.js') ?>
<?php echo $this->Html->script('lightbox.min.js') ?>
<?php echo $this->Html->css('datatables.min.css') ?>
<?php echo $this->Html->css('lightbox.min.css') ?>
<?php $this->assign('title', '¡Sube tu Gif!') ?>
<h3 class="titulo-seccion">Dashboard</h1>
<div id="bandejaUsuario">
   <table id="bandeja" class="display responsive-table" cellspacing="0" width="100%">
      <thead>
         <tr>
            <th class="center-align">Nombre</th>
            <th class="center-align">Imagen</th>
            <th class="center-align">Estatus</th>
            <?php 
            //Si el usuario es admin, mostramos la columna de menú
            if ($this->Session->read('Usuario.usu_tipo') == ADM): ?>
            <th class="center-align">Menú</th>
        	<?php endif; ?>
         </tr>
      </thead>
   </table>
</div>
<br>
<script type="text/javascript">
	//Declaramos variables globales por fuera para que la función de cambiar estatus las pueda ocupar 
	//y también las que se encuentren dentro del evento ready
	var html = '';
	//Mensajes de estatus
	var estatus = <?php echo json_encode([PENDIENTE => LPENDIENTE, RECHAZADO => LRECHAZADO, APROBADO => LAPROBADO]); ?>;
	//Iconos para los estatus
	var iconoPendiente = '<i class="material-icons light-blue-text text-darken-1">info</i>';
	var iconoRechazado = '<i class="material-icons pink-text">error</i>';
	var iconoAprobado = '<i class="material-icons green-text text-accent-4">done_all</i>';

$(document).ready(function() {
	var bandeja = $('#bandeja');
	//Generamos un template para las imágenes
	var template = '<a href="<?php echo Router::url('/', true)?>{index}" data-lightbox="mosaico" data-title="{nombre}">';
	template += '<img class="responsive-img img-mosaico" alt="Cargando Gif" src="<?php echo Router::url('/', true)?>{index}" style="width:120px;">';
	template += '</a>';
	//Generamos la bandeja de imágenes
    bandeja.DataTable( {
        'ajax': '<?php echo $this->Html->url(["controller" => "usuarios","action" => "index"]); ?>',
        'columns': [
            { "data": 'Gif.img_nombre' },
            { "data": 'Gif.img_ruta' },
            { "data": 'Gif.img_estatus' },
            <?php 
            //Si el usuario es admin, mostramos la columna de menú
            if ($this->Session->read('Usuario.usu_tipo') == ADM): ?>
            { "data": 'Gif.img_nombre' },
        	<?php endif; ?>
        ],
		"columnDefs": [
			{ "orderable": false, "targets": [1, 2, <?php if ($this->Session->read('Usuario.usu_tipo') == ADM): ?> 3 <? endif; ?>] },
			{ "searchable": false, "targets": [1, 2, <?php if ($this->Session->read('Usuario.usu_tipo') == ADM): ?> 3 <? endif; ?>] }
		],
		"bLengthChange": false,
		"order": [],
        "oLanguage":{
            "sProcessing":     "Procesando...",
            "sZeroRecords":    "No se encontraron gifs con ese nombre",
            "sInfo":           "Mostrando gifs _START_ al _END_. &nbsp;&nbsp;&nbsp;&nbsp;Total de gifs: _TOTAL_",
            "sInfoEmpty":      "Mostrando gifs 0 al 0 de un total de 0 gifs",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ gifs)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "ir al inicio",
                "sLast":     "ir al final",
                "sNext":     "siguiente »",
                "sPrevious": "« anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
		"createdRow": function( row, data, dataIndex ) {
			//Generamos el tag de imagen para la columna de imagen
			html = template.replace(/\{index}/g, data.Gif.img_ruta).replace('{nombre}', data.Gif.img_nombre);
		    $('td:eq(1)', row).html(html).addClass('center-align');
		    //Generamos la etiqueta de los estatus
		    switch (data.Gif.img_estatus) {
		    	case '<?php echo PENDIENTE ?>':
		    		html = '<p id="estatusImg'+data.Gif.imagen_id+'">'+iconoPendiente+' '+estatus[data.Gif.img_estatus]+'<p>';
		    		break;
		    	case '<?php echo RECHAZADO ?>':
		    		html = '<p id="estatusImg'+data.Gif.imagen_id+'">'+iconoRechazado+' '+estatus[data.Gif.img_estatus]+'<p>';
		    		break;
		    	case '<?php echo APROBADO ?>':
		    		html = '<p id="estatusImg'+data.Gif.imagen_id+'">'+iconoAprobado+' '+estatus[data.Gif.img_estatus]+'<p>';
		    		break;
		    }
		    $('td:eq(2)', row).html(html).addClass('center-align');
		    //Generamos la columna de admin para cambiar los estatus
		    var href = '<?php echo $this->Html->url(["controller" => "usuarios","action" => "cambiarEstatus"]); ?>/'+data.Gif.imagen_id+'/'
		    html = '<a onclick="cambiarEstatus(event, this.href);" class="tooltipped cambiar-estatus" data-position="left" data-tooltip="Rechazar Gif :(" href="'+href+'<?php echo RECHAZADO ?>">'+iconoRechazado+'</a>'
		    html += '<a onclick="cambiarEstatus(event, this.href);" class="tooltipped cambiar-estatus" data-position="left" data-tooltip="Aceptar Gif :D" href="'+href+'<?php echo APROBADO ?>">'+iconoAprobado+'</a>'
		    $('td:eq(3)', row).html(html).addClass('center-align');;
		    //Centramos las columnas restantes
		    $('td:eq(0)', row).addClass('center-align');
		},
	    "initComplete": function (settings, data) {
	    	//Mostramos un mensaje distinto si el usuario no tiene imágenes
	    	if (data.data.length == 0) {
	    		html = '<div class="center-align"><p>No has subido ninguna imagen</p>';
	    		html += '<a class="waves-effect  btn btnd" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "subirGif"]); ?>">¡Subir Gif!</a>';
	    		html += '</div>';
	    		bandeja.parent().html(html);
	    	}
	    }
    } );

	//Configuramos el lightbox
	lightbox.option({
      'resizeDuration': 100,
      'alwaysShowNavOnTouchDevices': true,
      'albumLabel': 'Imagen %1 de %2',
    });

	//Activamos los tooltip
	bandeja.on( 'draw.dt', function () {
	    $('.tooltipped').tooltip({delay: 50});
	} );
});
	
    /**
     * Función que permite cambiar el estatus de un Gif
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
     * @param {Event} event Evento del elemento, lo usamos para detener la acción y procesar los datos con ajax
     * @param {url} url Link para hacer la petición ajax  
     * @return void
     */
	function cambiarEstatus(event, url){
		event.preventDefault();
		$.ajax({
			url: url,
			type: 'GET',
			beforeSend: function( xhr ) {
				//Mostramos mensaje de envío cuando se procese los datos
				//loader.show('fast');
			},
	        success: function(data, textStatus, request) {
	        	imagenId = request.getResponseHeader('imagenId');
	           	imagenEstatus = request.getResponseHeader('imagenEstatus');
	           	if (imagenId != null && imagenEstatus != null) {
	           		//Modificamos el icono del estatus si el servidor pudo cambiarlo
				    switch (imagenEstatus) {
				    	case '<?php echo RECHAZADO ?>':
				    		html = iconoRechazado+' '+estatus[imagenEstatus];
				    		break;
				    	case '<?php echo APROBADO ?>':
				    		html = iconoAprobado+' '+estatus[imagenEstatus];
				    		break;
				    }
	           		$('#estatusImg'+imagenId).html(html);
	           		Materialize.toast('Estatus modificado', 3000, 'mensaje-alerta');
	           	} else {
	           		Materialize.toast('No se pudo modificar el estatus, inténtalo de nuevo', 3000, 'mensaje-alerta');
	           	}
	        }
		});
		
	}
</script>