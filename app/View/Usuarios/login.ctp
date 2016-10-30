<?php echo $this->Form->create('Usuario', 
   ['url' => ['controller' => 'usuarios', 'action' => 'login'], 
   'inputContainer' => false,
   'id' => 'formularioUsuario',
   'class' => 'col s12'
   ]); ?>
<div class="row">
   <div class="input-field col s12 m4 offset-m4">
      <?php echo $this->Form->input('usu_cuenta', ['class' => 'validate', 'placeholder' =>'Email', 'label' => false, 'required' => false]); ?>
   </div>
   <div class="input-field col s12 m4 offset-m4">
      <?php echo $this->Form->input('usu_contrasenia', ['id' => 'contrasenia','class' => 'validate', 'type' => 'password', 'label' => false, 'placeholder' =>'Contraseña', 'required' => false]); ?>
   </div>
</div>
<!-- Mensaje para indicar el procesamiento de datos-->
<div class="center-align" id="loader" hidden>
   <div class="progress">
      <div class="indeterminate"></div>
   </div>
</div>
<div class="row">
   <div class="input-field col s12 m4 offset-m4">
      <?php echo $this->Form->button('Iniciar sesión', ['class' => 'btn btnd']); ?>
   </div>
</div>
<?php $this->Form->end(); ?>
<script type="text/javascript">
<?php if (isset($logueadoConExito) && $logueadoConExito): ?>
   window.location.href = '<?php echo $this->Html->url(["controller" => "usuarios","action" => "index"]) ?>';
<?php else: ?>
$(document).ready(function(){ 
   //Variables generales
   var contenidoLayout = $('#contenedorFormulario');
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
         url: '<?php echo $this->Html->url(["controller" => "usuarios","action" => "login"]); ?>',
         type: tipoPeticion,
         data: datosFormulario,
         beforeSend: function( xhr ) {
            //Mostramos mensaje de envío cuando se procese los datos
            loader.show('fast');
         },
         success: function(data, textStatus, request) {
            contenidoLayout.html(data);
            //Ocultamos el mensaje de envío de datos
            loader.hide('fast');
            //Si hay errores, envíamos mensaje de info
            if (request.getResponseHeader('exito') == null) {
               Materialize.toast('Por favor verifica tu información', 5000, 'mensaje-alerta');
            }
         }
      });
       return false;
   });
});
<?php endif; ?>
</script>