<?php


define('templates_url', __DIR__. '/templates'); //el __DIR__ nos ayuda a obtener la ruta absoluta del archivo
//donde estamos sacando esto. Lo usamos con el fin de poder usar el template con exito
define('funciones_url', __DIR__. 'funciones.php');
define("CARPETA_IMAGENES", $_SERVER['DOCUMENT_ROOT'] . "/imagenes/");
define("IMAGENES_VENDEDORES", $_SERVER['DOCUMENT_ROOT'] . "/imagenesVendedores/");

function incluirTemplate(string $nombreTemplate, bool $inicio = false)
{
    include templates_url."/${nombreTemplate}.php"; //usamos la constante que declaramos antes
}

function autenticado(): bool
{
    session_start();
    $auth = $_SESSION['login'];

    if (!$auth) {
        header("Location: /index.php");
        return false;
    }
    
    return true;
}

//sanitizar / escapar datos

function sanitizar($html): string
{
    $s=htmlspecialchars($html);//sanitizamos los datos para evitar cualuiqer aletracion de atacantes

    return $s;
}

function debuguear($clase)
{
    echo "<pre>";
    var_dump($clase);
    echo "</pre>";
    die();
}

//validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos); //in_array busca un elemento dentro de un arreglo
}

//mostrar los mensajes
function mostrarNotificaciones($codigo)
{
    $mensaje='';

    switch ($codigo) {
        case 1:
            $mensaje = 'Se registro con exito';
            break;
        case 2:
            $mensaje = 'Se actualizo con exito';
            break;
        case 3:
            $mensaje = 'Se ha eliminado correctamente';
            break;
        default:
        $mensaje = false;
        break;
    }


    return $mensaje;
}

function validarOredireccionar($url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${url}");
    }

    return $id;
}
