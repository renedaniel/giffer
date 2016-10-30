<?php
/**
 * Controlador para las acciones de los Usuario.
 *
 * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
 */
App::uses('AppController', 'Controller');

class UsuariosController extends AppController
{

    /**
     * Método que muestra la bandeja del usuario
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @return void
     */
    public function index(){
        if ($this->request->is('ajax')) {
            $this->loadModel('Gif');
            $this->layout = false;
            $this->view = '/Elements/json';
            $gifs['data'] = $this->Gif->find('all', [
                'fields' => ['imagen_id','img_ruta', 'img_nombre', 'img_estatus'], 
                'order' => 'img_creado DESC',
                'conditions' => ['usuario_id' => $this->Session->read('Usuario.usuario_id')]
            ]);
            $this->set('data', json_encode($gifs));
        }
    }






    /**
     * Método que genera la vista para que un usuario se pueda registrar o actualizar sus datos vía ajax
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @param int|null $usuarioId El id del usuario si se quiere actualizar los datos
     * @return void
     */
    public function edicionUsuario($usuarioId = null){
        //Si se envia el id del usuario entonces vamos a editar y cargamos al usuario
        if (isset($usuarioId)) {
            $usuario = $this->Usuario->read(null, $usuarioId);
        }
        //Guardamos los datos e indicamos si fue actualización o creación
        if (isset($this->request->data) && !empty($this->request->data && $this->request->is('ajax'))) {
            $datosUsuario = [];
            //Si se está creando el usuario agregamos la fecha de creación y el tipo de usuario.
            if (!isset($usuarioId)) {
                $datosUsuario = [
                    'usu_creado' => date("Y-m-d"),
                    'usu_tipo'  => USU
                ];
            }
            $datosUsuario = array_merge($datosUsuario, $this->request->data['Usuario']);
            if ($this->Usuario->save($datosUsuario)) {
                $this->set('guardadoConExito', true);
                $this->response->header('exito', true);
                //Al registrase el usuario con exito, iniciamos sesión
                $datosUsuario['usuario_id'] = $this->Usuario->getLastInsertID();
                $this->Session->write('Usuario', $datosUsuario);
            }
            $this->layout = false; 
        }
        $this->set(compact('usuario'));
    }

    /**
     * Método que genera la vista para que un usuario se pueda loguear vía ajax
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @return void
     */
    public function login(){
        //Si el usuario hace la petición lo buscamos en la BD
        if (isset($this->request->data) && !empty($this->request->data && $this->request->is('ajax'))) {
            $condiciones = $this->request->data['Usuario'];
            $condiciones['usu_contrasenia'] = hash('sha512', $condiciones['usu_contrasenia']);
            $usuario = $this->Usuario->find('first', ['conditions' => $condiciones]);
            if (isset($usuario) && !empty($usuario)) {
                $this->Session->write($usuario);
                $this->set('logueadoConExito', true);
                $this->response->header('exito', true);
            } else {
                $this->Usuario->invalidate('usu_contrasenia', __('Usuario y/o Contraseña incorrecta.'));
            }
            $this->layout = false; 
        } else {
           $this->layout = 'login';
        }
        $this->set(compact('usuario'));
    }

    /**
     * Método que cierra la sesión de un usuario
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @return void
     */
    public function logout(){
        $this->Session->destroy();
        return $this->redirect(['controller' => 'principal', 'action' => 'index']);
    }

}
