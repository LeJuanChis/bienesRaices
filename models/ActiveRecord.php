<?php 

namespace Model;

class ActiveRecord{
        //BASES DE DATOS
    //conexion estatia a la base de datods para no instanciar cadas vez que se crea una propiedad
    protected static $db;
    //mapeamos las columnas de la base de datos
    protected static $columnasDB = [];

    protected static $tabla = '';

    //ERRORES
    protected static $errores = [];

    public function guardar()
    
    {
        
        if (!empty($this->id)) {
            
            $this->actualizar();
        } else {
            
            $this->crear();
        }
    }

    public function crear()
    {

        //sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $sql = "INSERT INTO ". static::$tabla ." ( ";
        $sql .= join(", ", array_keys($atributos)); //sacamos las llaves del array y las convertimos a String para reutilizarlas
        $sql .= ") VALUES (' ";
        $sql .= join("', '", array_values($atributos)) . "')"; //sacamos los datos del array y los convertimos a string para insertarlos

        $result = self::$db->query($sql);
        
        if ($result) {
            header("Location: /admin?resultado=1");
        }
    }

    public function actualizar()
    {
        $atributos = $this->sanitizarDatos(); //sanitizar los datos

        $valores = [];
        foreach ($atributos as $key =>$value) {
            $valores[] = "${key} = '${value}'";
        }
        $query= "UPDATE ". static::$tabla ." SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id= '";
        $query .= self::$db->escape_string($this->id). "' LIMIT 1";

        $resultado = self::$db->query($query);
        if ($resultado) {
            header("Location: /admin?resultado=2");
        }
    }

    public function eliminar()
    {
        $sql = "DELETE FROM ". static::$tabla ." WHERE id = ".self::$db->escape_string($this->id);
    
        $resultado=self::$db->query($sql);
        
        if ($resultado) {
            $this->eliminarImagen();
            header("Location: /admin?resultado=3");
        }else{
            header("Location: /admin");
        }
    }

    //subir imagenes

    public function setImagen($imagen)
    {//setear la imagen

        //eliminar la imagen anterior
        
        if (!empty($this->id)) {
            
            $this->eliminarImagen();
        }

        if ($imagen) {
            $this->imagen = $imagen;
            
        }
    }
    //eliminar archivos
    public function eliminarImagen()
    {
        //comprobart si existe el archivo
        $existeArchivoPropiedad = file_exists(CARPETA_IMAGENES.$this->imagen);
        $existeArchivoVendedor = file_exists(IMAGENES_VENDEDORES.$this->imagen);
        
        if ($existeArchivoPropiedad) {
            unlink(CARPETA_IMAGENES.$this->imagen);
        }elseif($existeArchivoVendedor){
            unlink(IMAGENES_VENDEDORES.$this->imagen);
        }
    }

    public static function setDB($database)
    {
        self::$db = $database; //sintaxis para acceder a una propiedad estatica
    }

    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') {
                continue;
            } //hacemos que omita la columna de id ya que no la necesitamos
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //funcion para sanitizar datos
    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) { //el valor 'key' es el titulo de la propiedad y el 'value' es el valor de la propiedad
            $sanitizado[$key] = self::$db->escape_string($value); //sanitizamos los datos como string
        }
        return $sanitizado;
    }

    //obtenemos los errores
    public static function getErrores()
    {

        return static::$errores;
    }

    public function validar()
    {
        static::$errores=[];
        return static::$errores;
    }

    //lista de odas las propiedades

    public static function all()
    {
        $sql = "SELECT * FROM ".static::$tabla;//static hace referencia a las herencias, o sea que busca en las herencias el valor de esta propiedad estatica

    

        //para obtener los resultados y sguir buenas practicas con active record debemos pasar el array que nos llega a un array con objetos dentro
        $resultado = self::consultarDB($sql);
        
        return $resultado;
    }

    //obtiene determinado numero de registros
    public static function get($cantidadRegistros)
    {
        $sql = "SELECT * FROM ".static::$tabla . " LIMIT " .$cantidadRegistros;//static hace referencia a las herencias, o sea que busca en las herencias el valor de esta propiedad estatica

        //para obtener los resultados y sguir buenas practicas con active record debemos pasar el array que nos llega a un array con objetos dentro
        $resultado = self::consultarDB($sql);
       
        return $resultado;
    }

    public static function consultarDB($sql)
    {
        $resultado =self::$db->query($sql);
       
        $array=[];

        while ($row = $resultado->fetch_assoc()) {
            //ahora obtenemos un array con varios objetos dentro
            $array[] = static::crearObejeto($row);
        }

        //liberar memoria del servidor
        $resultado->free();
        
        return $array;
    }

    protected static function crearObejeto($registro)
    {
        //creamos el objeto
        $objeto = new static;
        
        foreach ($registro as $key=>$value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
                
            }
        }
        return $objeto;
    }

    //buscar una propiedad por su id
    public static function find($id)
    {
        $sql = "SELECT * FROM ". static::$tabla ." WHERE id = ${id}";

        $resultado = self::consultarDB($sql);
        return array_shift($resultado); //array_shift nos retorna el primer elemento de un array
    }

    //sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key=>$value) {
            if (property_exists($this, $key)  && !is_null($value)) {
                $this->$key=$value;
            }
        }
    }
}