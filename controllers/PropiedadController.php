<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $mensaje = $_GET['resultado'] ?? null;
        
        
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'mensaje' => $mensaje,
            'vendedores' =>$vendedores
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //crear una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);
                
            //subida de imagenes
            //generar un nombre unico por imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                //realizar un resize a la imagen con intervetion
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            
            
                //seteamos el nombre de la imagen
                $propiedad->setImagen($nombreImagen);
            }
            
            //obtenemos los errores
            $errores = $propiedad->validar();
            
            if (empty($errores)) {
                //crear la carpeta para subir imagenes
                    //crear una carpeta
                    if (!is_dir(CARPETA_IMAGENES)) { //vefiricamos si la crpeta no existe
                        mkdir(CARPETA_IMAGENES); //creamos la carpeta con la ruta especificada
                    }
                //guardar la imagen en el servidor con intervetion
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                    
                //guardar en la base de datos
                $propiedad->guardar();
            }
        }

        $router -> render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();
        // Consultar para obtener los vendedores
        $vendedores = Vendedor::all();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = validarOredireccionar('/admin');

            // Obtener los datos de la propiedad
            $propiedad = Propiedad::find($id);
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['propiedad'];
            $id=$_POST['propiedad']['id'];
            
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if (!$id) {
                header("Location: /admin");
            }

            $propiedad= Propiedad::find($id);

            $propiedad->sincronizar($args);

            // Validación
            $errores = $propiedad->validar();

            // Subida de archivos
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }


                
            if (empty($errores)) {
                // Almacenar la imagen
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                // Guarda en la base de datos
                $resultado = $propiedad->guardar();

                if ($resultado) {
                    header('location: /propiedades');
                }
            }
        }




        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
        
            if ($id) {
                $tipo=$_POST['tipo'];
                
                if (validarTipoContenido($tipo)) {
                    $propiedad=Propiedad::find($id);
                
                        $propiedad->eliminar();
                }
            }else{
                header("Location: /admin");
            }
        }
    }
}
