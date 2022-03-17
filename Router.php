<?php 

namespace MVC;

class Router{
    public $rutasGET= [];
    public $rutasPOST=[];

    public function comprobarRutas(){
        session_start();

        $auth = $_SESSION['login'] ?? null;
        //arreglo de rutas privada
        $rutasPrivadas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', 
         '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['REQUEST_URI'] ?? '' ;
        $metodo = $_SERVER['REQUEST_METHOD'];

        
        
        //proteger las rutas
        if(in_array($urlActual, $rutasPrivadas)  && !$auth){ //saber si un elemento esta dentro de un array
            header("Location: /");
           
        }
        

        if($metodo === 'GET'){
           $urlActual = explode('?', $urlActual);
            $funcion = $this->rutasGET[$urlActual[0]] ?? null;
           
        }else{
            $urlActual = explode('?', $urlActual);
            $funcion = $this->rutasPOST[$urlActual[0]] ?? null;
        }
       

        if(isset($funcion)){
            //call user func nos funciona para llamar una funcion cuando no sabemos su nombre
            //en este caso le estamos pasando el nombre de la funcion y todo nuestro objeto
            //se puede llamar la funcion por medio de un array como lo hacemos aca, 
            //sin embargo nos pide un metodo estatico para funcionar
            call_user_func($funcion, $this);
        }else{
            echo "No existe la página";
        }
    }

    public function get($urlActual, $funcion){
        $this->rutasGET[$urlActual] = $funcion;
        
    }

    public function post($urlActual, $funcion){
        $this->rutasPOST[$urlActual] = $funcion;
        
    }

    //mostrar una vista
    public static function render($view, $datos = []){

        foreach($datos as $key => $values){
            $$key = $values;//significa variable de variable, lo que hace es crear una variable con el 
            //nombre del key de nuestro arreglo y le asigna ese valor. Luego se lo enviamos a la vista
        }
        //esto nos almacena lo que le sigue en memoria
        ob_start();
        include __DIR__.'/views/'.$view.'.php'; //por ejemplo, almacena esto en el servidor

        $contenido = ob_get_clean(); // limpiamos lo que esta en memoria y lo pasamos a una variable
        include __DIR__.'/views/layout.php';

    }


}