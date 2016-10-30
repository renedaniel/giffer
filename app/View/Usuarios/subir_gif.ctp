<?php echo $this->Html->script('dropify.min.js') ?>
<?php echo $this->Html->css('dropify.min.css') ?>
<?php $this->assign('title', '¡Sube tu Gif!') ?>
<h3 class="titulo-seccion">¡Sube tu Gif!</h1>
<br>
<!-- Formulario para el registro de un gif -->
<div class="row " id="contenedorFormulario">
	<?php echo $this->Form->create('Gif', 
		['url' => ['controller' => 'usuarios', 'action' => 'subirGif'], 
		'inputContainer' => false,
		'id' => 'formularioUsuario',
		'class' => 'col s12 dropzone',
		'type' => 'file'
		]); ?>
	<div class="row">
		<div class="input-field col s12">
			<?php echo $this->Form->input('img_nombre', ['class' => 'validate', 'label' =>'Nombre de tu Gif', 'required' => false]); ?>
		</div>
	</div>
	<div class="row">
	    <div class="file-field input-field col s12">
	    	<?php echo $this->Form->input('img_ruta', ['id' => 'gif','class' => 'validate', 'label' =>false, 'required' => false, 'type' => 'file']); ?>
	    </div>  		
	</div>
	<div class="row">
		<div class="input-field col s6 right-align">
			<a href='<?php echo $this->Html->url(["controller" => "usuarios", "action" => "index"]) ?>' class="btn-large btnd btnc">Cancelar</a>
		</div>
		<div class="input-field col s6 lef-align">
			<?php echo $this->Form->button('&nbsp;&nbsp;Enviar&nbsp;&nbsp;', ['class' => 'btn-large btnd']); ?>
		</div>
	</div>
	<?php $this->Form->end(); ?>
</div>
<!-- Termina formulario para el registro de un gif -->
<script type="text/javascript">
$(document).ready(function(){	
	//Configuramos el plugin que muestra la imagen
	$('#gif').dropify({
		allowedFileExtensions : ['gif'],
		maxFileSize : '3M',
	    messages: {
	        'default': 'Arrastre o de clic para seleccionar su Gif',
	        'replace': 'Arrastre o de clic para reemplazar su Gif',
	        'remove':  'Eliminar',
	        'error':   'Ocurrio un error, inténtelo de nuevo'
	    },
	    error: {
	        'fileSize': 'El archivo debe pesar máximo {{ value }}',
	        'fileExtension': 'Sólo se permiten imágenes {{ value }}.'
	    },
	    tpl: {
	        message:'<div class="dropify-message"><span class="file-icon" /> <p class="center-align">{{ default }}</p></div>',
	    }
	});
});
</script>