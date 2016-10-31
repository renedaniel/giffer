<?php
/**
 * Modelo padre para todos los modelos
 *
 * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>  
 */
App::uses('Model', 'Model');

class AppModel extends Model {

    /**
    * Función para el $validates que verifica que un campo de un modelo no contenga tags html para evitar inyecciones de código
    * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
    * @param Array $check Dato envíado por el validador de cakep
    * @return boolean true si el campo no tiene tags html false sino 
    */   
    public function verificarSinHtml($check){
        $field = array_shift($check);
        $stringSinTags = strip_tags($field);
        if ($field === $stringSinTags) {
            return true;
        }
        return false;
    }

}
