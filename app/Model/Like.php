<?php

App::uses('AppModel', 'Model');

/**
 * Modelo para los likes de las imágenes
 * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
 */
class Like extends AppModel {

    public $name = 'Like';
    public $useTable = 'img_usu_like';
    public $primaryKey = 'img_usu_like_id';
    public $recursive = -1;

}
