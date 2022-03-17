<?php

namespace Model;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'tblPropiedades';
    //mapeamos las columnas de la base de datos
    protected static $columnasDB = [
        'id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamientos',
        'fecha_creacion', 'id_vendedor'
    ];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $fecha_creacion;
    public $id_vendedor;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->fecha_creacion = date("Y/m/d");
        $this->id_vendedor = $args['id_vendedor'] ?? '';
    }

    public function validar()
    {
        //vamos a realizar la validacion
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripcion debe ser mayor a 50 caracteres";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir el numero de habitaciones";
        }

        if (!$this->wc) {
            self::$errores[] = "Debes añadir el numero de baños";
        }

        if (!$this->estacionamientos) {
            self::$errores[] = "Debes añadir el numero de estacionamientos";
        }

        if (!$this->id_vendedor) {
            self::$errores[] = "Debes seleccionar un vendedor";
        }

        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

}
