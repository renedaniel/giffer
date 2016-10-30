<?php

App::uses('AppModel', 'Model');

/**
 * Modelo de Usuario
 * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
 */
class Usuario extends AppModel {

    public $name = 'Usuario';
    public $useTable = 'usuario';
    public $primaryKey = 'usuario_id';
    public $recursive = -1;
    public $datos = [];

    //Validamos los datos del modelo
    public $validate = [
        'usu_nombre' => [
            'obligatorio' => [
                'rule' => 'notBlank',
                'message' => 'El nombre es obligatorio'
                ],
            'verificarSinHtml' => [
                'rule' => ['verificarSinHtml'],
                'message' => 'Este campo no permite tags HTML'
                ],   
            ],
        'usu_primer_apellido' => [
            'obligatorio' =>[
                'rule' => 'notBlank',
                'message' => 'El primer apellido es obligatorio'
                ],
            'verificarSinHtml' => [
                'rule' => ['verificarSinHtml'],
                'message' => 'Este campo no permite tags HTML'
                ],   
            ],
        'usu_segundo_apellido' => [
            'obligatorio' => [
                'rule' => 'notBlank',
                'message' => 'El segundo apellido es obligatorio'
                ],
            'verificarSinHtml' => [
                'rule' => ['verificarSinHtml'],
                'message' => 'Este campo no permite tags HTML'
                ],   
            ],  
        'usu_cuenta' => [
            'obligatorio' => [
                'rule' => 'notBlank',
                'message' => 'La cuenta es obligatoria'
                ],
            'esUnico' => [
                'rule' => 'isUnique',
                'message' => 'Ya existe un usuario con este correo electrónico'
                ],
            'verificarSinHtml' => [
                'rule' => ['verificarSinHtml'],
                'message' => 'Este campo no permite tags HTML'
                ],  
            'email' => [
                'rule' => ['email'],
                'message' => 'Ingrese un email válido'
                ],   
            ], 
        'usu_contrasenia' => [
            'obligatorio' => [
                'rule' => 'notBlank',
                'on' => 'create',
                'message' => 'La contraseña es obligatoria'
                ],
            'minimoCaracteres'=> [
                'rule'=> ['minLength', '5'],
                'message'=>'La contraseña debe tener por lo menos 5 caracteres',
                ],   
            ], 
        'usu_repetir_contrasenia' => [
            'obligatorio' => [
                'rule' => 'notBlank',
                'on' => 'create',
                'message' => 'Debe confirmar la contraseña'
                ], 
            'minimoCaracteres'=> [
                'rule'=> ['minLength', '5'],
                'message'=>'La contraseña debe tener por lo menos 5 caracteres',
                ],  
            'contrasenas_iguales' => [
                'rule' => 'contraseniasIguales',
                'message' => 'Las contraseñas no coinciden'
                ], 
            ],       
    ];


    /**
     * Ciframos la contraseña y eliminamos el campo de confirmar contraseña antes de guardar los datos y después de validarlos    
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
     * @param Array Arreglo obligatorio según el API
     * @return boolean true para continuar con el flujo del modelo
     */
    public function beforeSave($options = []) {
        parent::beforeSave($options);
        //Ciframos la contraseña y eliminamos el campo de confirmar contraseña
        if (isset($this->data['Usuario']['usu_contrasenia']) && !empty($this->data['Usuario']['usu_contrasenia'])) {
            $this->data['Usuario']['usu_contrasenia'] = hash('sha512', $this->data['Usuario']['usu_contrasenia']);
            unset($this->data['Usuario']['usu_repetir_contrasenia']);
        }
        return true;
    }



    /**
     * Verifica que el campo usu_repetir_contrasenia sea igual a la contraeña del usuario, si lo es elimina el campo usu_repetir_contrasenia del data para actualizar el usuario
     * 
     * @author René Daniel Galicia Vázquez <renedaniel191992@gmail.com>
     * @return boolean true si las contraseñas son iguales, false sino
     */
    public function contraseniasIguales($confirmacionContrasenia){
        if (isset($this->data['Usuario']['usu_contrasenia']) && !empty($this->data['Usuario']['usu_contrasenia'])) {
            if ($confirmacionContrasenia['usu_repetir_contrasenia'] == $this->data['Usuario']['usu_contrasenia']) {
                return true;
            } 
            return false;
        } else if(isset($this->data['Usuario']['usu_contrasenia']) && empty($this->data['Usuario']['usu_contrasenia']) && !empty($confirmacionContrasenia['usu_repetir_contrasenia'])) {
            $mensajeError = 'Primero debe ingresar una contraseña';
            $this->invalidate('usu_repetir_contrasenia', __($mensajeError));
        }
        return true;
    }

}
