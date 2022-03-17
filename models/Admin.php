<?php 

namespace Model;

class Admin extends ActiveRecord{
    //base de datos 
    protected static $tabla = 'tblUsuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = "El email es obligatorio";
        }

        if(!$this->password){
            self::$errores[] = "La contraseña es obligatoria";
        }


        return self::$errores;
    }

    public function verificarUsuario(){
        //comprobar si existe un usuario

        $sql = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."' LIMIT 1";
        $resultado = self::$db->query($sql);

        if(!$resultado->num_rows){
            self::$errores [] = "El usuario no existe";
            return;
        }

        return $resultado;

    }

    public function verificarContraseña($resultado){
        $usuario = $resultado->fetch_object();
        
        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado){
            self::$errores[] = "La contraseña es incorrecta";
        }

        return $autenticado;
    }

    public function autenticarUsuario(){
        session_start();
        $_SESSION['usuario'] = $this;
        $_SESSION['login'] = true;

        header("Location: /admin");
        // debuguear($_SESSION);
    }
}