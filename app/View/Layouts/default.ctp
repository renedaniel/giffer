<!DOCTYPE html>
<html lang="es">
<head>
  <?php echo $this->Html->charset() ?>
  <meta http-equiv="Content-Type" content="text/html"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title><?php echo $this->fetch('title') ?> || Giffer</title>
  <?php
    //Meta de la aplicación
    echo $this->Html->meta('icon');
    //Hojas de estilo de la aplicación
    echo $this->Html->css('materialize.min.css'); 
    echo $this->Html->css('font-awesome.min.css');
    echo $this->Html->css('style.css');
    //Scripts js de la aplicación
    echo $this->Html->script('jquery.min.js');
    echo $this->Html->script('materialize.min.js');
    echo $this->Html->script('init.js');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
</head>
<body>
  <!-- Barra de navegación -->
  <div class="navbar-fixed">
    <nav class="grey lighten-3" role="navigation" id="menuNavegacion">
      <div class="nav-wrapper container">
        <a id="logo-container" href="<?php echo $this->Html->url(["controller" => "principal","action" => "index"]); ?>" class="brand-logo"><?php echo $this->Html->image('logo.png', ['alt' => 'Giffer', 'id' =>'logo']); ?></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="waves-effect  btn <?php echo  ($this->request->params['controller'] == 'principal' && $this->request->params['action'] == 'index') ?'active':''?>" href="<?php echo $this->Html->url(["controller" => "principal"]); ?>">Inicio</a></li>
          <?php if($this->Session->check('Usuario')): ?>
            <li><a class="waves-effect  btn <?php echo  ($this->request->params['controller'] == 'usuarios' && $this->request->params['action'] == 'subirGif') ?'active':''?>" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "subirGif"]); ?>">¡Subir Gif!</a></li>
            <li><a class="waves-effect  btn <?php echo  ($this->request->params['controller'] == 'usuarios' && $this->request->params['action'] == 'index') ?'active':''?>" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "index"]); ?>">Dashboard</a></li>
            <li><a class="waves-effect  btn" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "logout"]); ?>">Cerrar sesi&oacute;n</a></li>
          <?php else: ?>
            <li><a class="waves-effect  btn" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "login"]); ?>">Iniciar sesi&oacute;n</a></li>
            <li><a class="waves-effect  btn <?php echo  ($this->request->params['controller'] == 'usuarios' && $this->request->params['action'] == 'edicionUsuario') ?'active':''?>" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "edicionUsuario"]); ?>">Registrate</a></li>
          <?php endif; ?>
        </ul>
        <ul id="nav-mobile" class="side-nav">
          <li><a class="waves-effect  btn btnm <?php echo  ($this->request->params['controller'] == 'principal' && $this->request->params['action'] == 'index') ?'active':''?>" href="<?php echo $this->Html->url(["controller" => "principal"]); ?>">Inicio</a></li>
          <?php if($this->Session->check('Usuario')): ?>
            <li><a class="waves-effect  btn btnm <?php echo  ($this->request->params['controller'] == 'usuarios' && $this->request->params['action'] == 'subirGif') ?'active':''?>" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "subirGif"]); ?>">¡Subir Gif!</a></li>
            <li><a class="waves-effect  btn btnm <?php echo  ($this->request->params['controller'] == 'usuarios' && $this->request->params['action'] == 'index') ?'active':''?>" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "index"]); ?>">Dashboard</a></li>
            <li><a class="waves-effect  btn btnm" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "logout"]); ?>">Cerrar sesi&oacute;n</a></li>
          <?php else: ?>
            <li><a class="waves-effect  btn btnm" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "login"]); ?>">Iniciar sesi&oacute;n</a></li>
            <li><a class="waves-effect  btn btnm <?php echo  ($this->request->params['controller'] == 'usuarios' && $this->request->params['action'] == 'edicionUsuario') ?'active':''?>" href="<?php echo $this->Html->url(["controller" => "usuarios","action" => "edicionUsuario"]); ?>">Registrate</a></li>
          <?php endif; ?>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      </div>
    </nav>
  </div>
      
  <!-- Contenido de las vistas -->
  <?php echo $this->Flash->render(); ?>
  <div class="row" id="contenidoLayout">
      <?php echo $this->fetch('content'); ?>
  </div>

  <!-- Social -->
  <section id="lab_social_icon_footer">
    <div class="container">
      <div class="text-center center-block">
          <a href="#"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
          <a href="#"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
          <a href="#"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
          <a href="#"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
      </div>
    </div>
  </section>
  <!-- Footer -->
  <footer class="page-footer site-footer teal grey darken-3">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="brown-text text-lighten-3" href="#">René Daniel</a>
      </div>
    </div>
  </footer>
  </body>
</html>
