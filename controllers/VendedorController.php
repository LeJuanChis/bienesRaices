<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedorController
{
    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor= new Vendedor($_POST['vendedor']);
            //nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen']) -> fit(800, 600);
            
                $vendedor->setImagen($nombreImagen);
            }

            $errores = $vendedor->validar();

            if (empty($errores)) {
                //crear carpeta en caso de qu no exista
                if (!is_dir(IMAGENES_VENDEDORES)) {
                    mkdir(IMAGENES_VENDEDORES);
                }
                
                $image->save(IMAGENES_VENDEDORES . $nombreImagen);
                $vendedor->guardar();
            }
        }

        $router-> render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' =>  $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id= validarOredireccionar("/admin");
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $args = $_POST['vendedor'];

            $vendedor ->sincronizar($args);
            
            $errores = $vendedor->validar();
            
            //nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen']) -> fit(800, 600);
                        
                $vendedor->setImagen($nombreImagen);
            }
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image->save(IMAGENES_VENDEDORES . $nombreImagen);
            }

            if (empty($errores)) {
                
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router){
        $vendedor = new Vendedor;

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id= $_POST['id'];
            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $vendedor=Vendedor::find($id);
                    $vendedor->eliminar();
                }
                

            }else{
                header("Location: /admin");
            }
            
           
        }
    }
}
