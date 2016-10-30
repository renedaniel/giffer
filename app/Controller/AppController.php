<?php
/**
 * Controlador padre para todos los controladores
 *
 * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
 */
App::uses('Controller', 'Controller');

class AppController extends Controller {

    /**
     * Callback que se ejecuta en todos los controladores antes de ejecutar una acción
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        //Verificamos la sesión del usuario
        $this->verificarSesion();
    }

    /**
     * Método que válida las secciones a las que un usuario puede entrar según su tipo de cuenta
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @return void
     */
    public function verificarSesion(){
        $paginasRestringidas = [];
        if (!$this->Session->check('Usuario')) {
            //Páginas restringidas para un usuario anónimo
            $paginasRestringidas = [
                'usuarios' => ['index', 'subirGif'],
            ];
        } elseif($this->Session->read('Usuario.usu_tipo') == USU) {
            //Páginas restringidas para un usuario registrado que no es admin
            $paginasRestringidas = [
                'usuarios' => ['edicionUsuario', 'login', 'cambiarEstatus'],
            ];
        }
        $controladorRequest = strtolower($this->request->params['controller']);
        $accionRequest = strtolower($this->request->params['action']);
        //Revisamos si un usuario quiere ingresar a una sección prohibida
        foreach ($paginasRestringidas as $controlador => $acciones) {
            foreach ($acciones as $accion) {
                if ($controladorRequest == $controlador && $accionRequest == strtolower($accion)) {
                    return $this->redirect(['controller' => 'principal']);
                }
            }
        }
    } 

}
