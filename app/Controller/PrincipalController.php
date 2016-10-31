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
        $gifs = $this->Gif->find('all', [
            'fields' => ['img_ruta', 'img_nombre'], 
            'limit' => $numeroRegistros, 
            'offset' => $offset,
            'order' => 'img_creado DESC',
            'conditions' => ['img_estatus' => APROBADO],
        ]);
        $this->set('data', json_encode($gifs));
    }

}
