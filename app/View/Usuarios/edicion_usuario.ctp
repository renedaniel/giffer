<?php $this->assign('title', 'Registro') ?>
<h3 class="titulo-seccion">¡Únete a Giffer!</h1>
<br>
<!-- Formulario para el registro de usuario -->
<div class="row " id="contenedorFormulario">
	<?php echo $this->Form->create('Usuario', 
		['url' => ['controller' => 'usuarios', 'action' => 'edicionUsuario'], 
		'inputContainer' => false,
		'id' => 'formularioUsuario',
		'class' => 'col s12'
		]); ?>
	<div class="row">
		<div class="input-field col s12">
			<?php echo $this->Form->input('usu_nombre', ['class' => 'validate', 'label' =>'Nombre(s)', 'required' => false]); ?>
		</div>
		<div class="input-field col s12 m6">
			<?php echo $this->Form->input('usu_primer_apellido', ['class' => 'validate', 'label' =>'Primer apellido', 'required' => false]); ?>
		</div>
		<div class="input-field col s12 m6">
			<?php echo $this->Form->input('usu_segundo_apellido', ['class' => 'validate', 'label' =>'Segundo apellido', 'required' => false]); ?>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<?php echo $this->Form->input('usu_cuenta', ['class' => 'validate', 'label' =>'Email', 'required' => false]); ?>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 m6">
			<?php echo $this->Form->input('usu_contrasenia', ['id' => 'contrasenia','class' => 'validate', 'type' => 'password', 'label' =>'Contraseña', 'required' => false]); ?>
		</div>
		<div class="input-field col s12 m6">
			<?php echo $this->Form->input('usu_repetir_contrasenia', ['class' => 'validate', 'type' => 'password', 'label' =>'Repetir contraseña', 'required' => false]); ?>
		</div>
	</div>
	<!-- Mensaje para indicar el procesamiento de datos-->
	<div class="center-align" id="loader" hidden>
	  <div class="progress">
	      <div class="indeterminate"></div>
	  </div>
	</div>
	<!-- Termina mensaje para indicar el procesamiento de datos-->
	<div class="row">
		<div class="input-field col s6 right-align">
			<a href='<?php echo $this->Html->url(["controller" => "principal", "action" => "index"]) ?>' class="btn-large btnd btnc">Cancelar</a>
		</div>
		<div class="input-field col s6 lef-align">
			<?php echo $this->Form->button('&nbsp;&nbsp;Enviar&nbsp;&nbsp;', ['class' => 'btn-large btnd']); ?>
		</div>
	</div>
	<?php $this->Form->end(); ?>
</div>
<!-- Termina formulario para el registro de usuario -->
<script type="text/javascript">
<?php if (isset($guardadoConExito) && $guardadoConExito): ?>
	//Si se guardaron los datos redirigimos al usuario
	window.location.href = '<?php echo $this->Html->url(["controller" => "usuarios","action" => "index"]) ?>';
<?php else: ?>
//Procesamos el formulario vía ajax
$(document).ready(function(){	
	//Variables generales
	var contenidoLayout = $('#contenidoLayout');
	var formularioUsuario = $("#formularioUsuario");
	var loader = $("#loader");
	//Enviamos el formulario vía ajax
	formularioUsuario.submit(function(e){
		//Obtenemos los datos del formulario
		var datosFormulario = formularioUsuario.serializeArray().reduce(function(obj, item) {
		    obj[item.name] = item.value;
		    return obj;
		}, {});
		var tipoPeticion = datosFormulario['_method'];
		//Eliminamos el método para enviar sólo los datos
		delete datosFormulario['_method']; 
		//Procesamos el formulario
		$.ajax({
			url: '<?php echo $this->Html->url(["controller" => "usuarios","action" => "edicionUsuario"]); ?>',
			type: tipoPeticion,
			data: datosFormulario,
			beforeSend: function( xhr ) {
				//Mostramos mensaje de envío cuando se procese los datos
				loader.show('fast');
			},
	        success: function(data, textStatus, request) {
	           contenidoLayout.html(data);
	           Materialize.updateTextFields();
	           //Ocultamos el mensaje de envío de datos
	           loader.hide('fast');
	           //Si hay errores, envíamos mensaje de info
	           if (request.getResponseHeader('exito') == null) {
	              Materialize.toast('Por favor verifica tu información', 3000, 'mensaje-alerta');
	           }
	        }
		});
	    return false;
	});
});
<?php endif; ?>
</script>