<?php

App::uses('AppModel', 'Model');

/**
 * Modelo para los Gif
 * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
 */
class Gif extends AppModel {

    public $name = 'Gif';
    public $useTable = 'imagen';
    public $primaryKey = 'imagen_id';
    public $recursive = -1;

    //Validamos los datos del modelo
    public $validate = [
        'img_nombre' => [
            'obligatorio' => [
                'rule' => 'notBlank',
                'message' => 'El nombre es obligatorio'
                ],
            'verificarSinHtml' => [
                'rule' => ['verificarSinHtml'],
                'message' => 'Este campo no permite tags HTML'
                ],   
            ],
        'img_ruta' => [
            'gif' =>[
                'rule'=> ['extension', ['gif']],
                'message' => 'Debe ingresar una imagen con extensión gif'
                ],  
            ],
    ];


    /**
     * Guardamos la imagen en el servidor y la ruta en la BD después de validarlos 
     *   
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
     * @param Array Arreglo obligatorio según el API
     * @return boolean true para continuar con el flujo del modelo
     */
    public function beforeSave($options = []) {
        parent::beforeSave($options);
        //Si se envía la imagen, la guardamos en el servidor
        if (isset($this->data['Gif']['usuario_id']) && $this->data['Gif']['img_ruta']) {
            //Obtenemos los datos de la imagen
            $nombreImagen = preg_replace('/\s+/', '', $this->data['Gif']['img_ruta']['name']);
            $rutaTmp = $this->data['Gif']['img_ruta']['tmp_name'];
            $dirDestinoImagen = WWW_ROOT.'img'.DS.'gifs'.DS.$this->data['Gif']['usuario_id'];
            
            //Si el directorio no existe lo creamos
            if (!is_dir($dirDestinoImagen)) {
                mkdir($dirDestinoImagen, 0755, true);
            }
            $destinoImagen = $dirDestinoImagen.DS.$nombreImagen;
            //Si el usuario subio una imagen con el mismo nombre, generamos un nombre nuevo
            if (file_exists($destinoImagen)) {
                $fecha = new DateTime();
                $nombreImagen = $fecha->getTimestamp().$nombreImagen;
                $destinoImagen = $dirDestinoImagen.DS.$nombreImagen;
            }
            //Copiamos la imagen al servidor y colocamos la ruta para la bd
            $rutaImagenBD = 'img/gifs/'.$this->data['Gif']['usuario_id'].'/'.$nombreImagen;
            copy($rutaTmp, $destinoImagen);
            $this->data['Gif']['img_ruta'] = $rutaImagenBD;
            return true;
        }
    }
}
