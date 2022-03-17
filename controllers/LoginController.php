<?php 

namespace Controllers;

use MVC\Router;
use Model\Admin;    
class LoginController{
    public static function login(Router $router){
        $errores = Admin::getErrores();
        $resultado=null;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)){
                $resultado=$auth -> verificarUsuario();
            }

            if(!$resultado){
                $errores = Admin::getErrores();
            }else{
                //verificar la contraseña
                $autenticado = $auth->verificarContraseña($resultado);

                 //autenticar el usuario
                if($autenticado){
                    $auth ->autenticarUsuario();
                }else{
                    $errores = Admin::getErrores();
                }
               
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header("Location: /");
    }
}