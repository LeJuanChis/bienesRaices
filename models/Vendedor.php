<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'tblVendedores';
    //mapeamos las columnas de la base de datos
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'imagen'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $imagen;


    public function __construct($args = [])
    {
        
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        
    }

    public function validar()
    {
        //vamos a realizar la validacion
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }

        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = "El telefono es obligatorio";
        }

        if(!preg_match("/[0-9]{10}/", $this->telefono)){
            self::$errores[] = "Formato no valido para el telefono";
        }

        if(!$this->imagen){
            self::$errores[] = "Debes añadir una imagen";
        }

        return self::$errores;
    }
}
