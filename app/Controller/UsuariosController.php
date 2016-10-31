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
            $condiciones = ['usuario_id' => $this->Session->read('Usuario.usuario_id')];
            if ($this->Session->read('Usuario.usu_tipo') == ADM) {
                //Si el usuario es admin, mostramos todas las imágenes y no sólo las de el
                $condiciones = [];
            }
            $gifs['data'] = $this->Gif->find('all', [
                'fields' => ['imagen_id','img_ruta', 'img_nombre', 'img_estatus'], 
                'order' => 'img_creado DESC',
                'conditions' => $condiciones
            ]);
            $this->set('data', json_encode($gifs));
        }
    }


    /**
     * Método que permite a un usuario subir un gif
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @return void
     */
    public function subirGif(){
        $this->loadModel('Gif');
        //Guardamos los datos e indicamos si fue actualización o creación
        if (isset($this->request->data) && !empty($this->request->data)) {
            $datosImagen = [
                'img_creado' => date("Y-m-d H:i:s"),
                'img_estatus' => PENDIENTE,
                'usuario_id' => $this->Session->read('Usuario.usuario_id'),
            ];
            $datosImagen = array_merge($datosImagen, $this->request->data['Gif']);
            if ($this->Gif->save($datosImagen)) {
                $this->Flash->success('Tu gif ha sido recibido');
                $this->redirect('index');
            } else {
                //Si la imagen era válida solicitamos al usuario que la suba de nuevo
                if (!isset($this->Gif->validationErrors['img_ruta'])) {
                    $this->Gif->invalidate('img_ruta', 'Debe volver a seleccionar la imagen');
                }
            }
        }
        $this->set(compact('gif'));
    }

    /**
     * Método que permite a un administrador cambiar el estatus de una imagen
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @param int|null $imagenId El id de la imagen que se quiere actualizar
     * @param int|null $imagenEstatus Estatus que se le colocará a la imagen
     * @return void
     */
    public function cambiarEstatus($imagenId = null, $imagenEstatus = null){
        if (isset($imagenId) && !empty($imagenId) && isset($imagenEstatus) && !empty($imagenEstatus) && $this->request->is('ajax')) {
            $estatusPermitidos = [PENDIENTE, RECHAZADO, APROBADO];
            if (in_array($imagenEstatus, $estatusPermitidos)) {
                $this->loadModel('Gif');
                $this->Gif->id = $imagenId;
                if ($this->Gif->saveField('img_estatus', $imagenEstatus)) {
                    $this->layout = false;
                    $this->response->header('imagenId', $imagenId);
                    $this->response->header('imagenEstatus', $imagenEstatus);
                    return $this->render('index');
                }
            }
        }
        return $this->redirect(['controller' => 'principal', 'action' => 'index']);
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
