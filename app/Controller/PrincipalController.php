<?php
/**
 * Controlador para las acciones generales.
 *
 * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
 */
App::uses('AppController', 'Controller');

class PrincipalController extends AppController
{




    /**
     * Método que genera la vista principal de Giffer :D
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @return void
     */
    public function index(){
        $numeroRegistros = NUM_IMAGENES;
        $offset = 0;    
        if ($this->request->is('ajax') && !empty($this->request->data)) {
            $offset = $this->request->data['offset'];
            $this->layout = false;
            $this->view = '/Elements/json';
        }

        $this->loadModel('Gif');
        $this->Gif->recursive = 1;
        $gifs = $this->Gif->find('all', [
            'fields' => ['imagen_id','img_ruta', 'img_nombre'], 
            'limit' => $numeroRegistros, 
            'offset' => $offset,
            'order' => 'img_creado DESC',
            'conditions' => ['img_estatus' => APROBADO],
        ]);
        $this->set('data', json_encode($gifs));
    }

    /**
     * Método que permite a un usuario dar like a una imagen
     *
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
     * @param int|null $imagenId El id de la imagen a la que se le está dando like
     * @return CakePHP view
     */
    public function darLike($imagenId = null){
        if (isset($imagenId) && !empty($imagenId) && $this->request->is('ajax')) {
            $this->loadModel('Like');
            $usuarioId = $this->Session->read('Usuario.usuario_id');
            $data = ['usuario_id' => $usuarioId, 'imagen_id' => $imagenId];
            //Revisamos si el usuario ya dio like a la imagen
            $likeEnImagen = $this->Like->find('count', ['conditions' => $data]);
            if ($likeEnImagen == 0 && isset($usuarioId)) {
                //Si no ha dado like guardamos el registro y enviamos la respuesta exitosa con el num de likes de la imagen
                if ($this->Like->save($data)) {
                    $numLikes = $this->Like->find('count', ['conditions' => ['imagen_id' => $imagenId]]);
                    $this->response->header('numLikes', $numLikes);
                    $this->response->header('like', true);
                }
            } else {
                //Si el usuario no ha iniciado sesiión indicamos el error
                if (!isset($usuarioId)) {
                    $this->response->header('faltaSesion', true);
                } else {
                    $this->response->header('like', 'already');
                }
            }
            $this->layout = false;
            return $this->render('index');
        }
        return $this->redirect(['controller' => 'principal', 'action' => 'index']);
    }

}
