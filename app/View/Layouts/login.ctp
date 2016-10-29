<!DOCTYPE html>
<html lang="es">
   <head>
      <?php echo $this->Html->charset() ?>
      <meta http-equiv="Content-Type" content="text/html"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
      <title>Login || Giffer</title>
      <?php
         //Meta de la aplicación
         echo $this->Html->meta('icon');
         //Hojas de estilo de la aplicación
         echo $this->Html->css('materialize.min.css'); 
         echo $this->Html->css('login.css');
         //Scripts js de la aplicación
         echo $this->Html->script('jquery-3.1.1.min.js');
         echo $this->Html->script('materialize.min.js');
         echo $this->Html->script('init.js');
         
         echo $this->fetch('meta');
         echo $this->fetch('css');
         echo $this->fetch('script');
      ?>
      <!-- CSS  -->
      <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
   </head>
   <body>
      <div class="center-align">
         <a id="logo-container" href="<?php echo $this->Html->url(["controller" => "principal","action" => "index"]); ?>" class="brand-logo">
         <?php echo $this->Html->image('logo.png', ['alt' => 'Giffer', 'id' =>'logo']); ?>
         </a>
      </div>
      <!-- Botón para registro -->
      <div class="row">
         <div class="col s12 m4 offset-m4">
            <a class="waves-effect btn-login" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "edicionUsuario"]); ?>">Registrate</a>
         </div>
      </div>
      <!-- Formulario para el registro de usuario -->
      <div class="row" id="contenedorFormulario">
         <?php echo $this->fetch('content') ?>
      </div>
   </body>
</html>