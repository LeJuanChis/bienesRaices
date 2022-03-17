<?php 

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        
        $propiedades = Propiedad::get(3);

        $router->render("paginas/index", [
            'inicio' => "inicio",
            'propiedades' =>$propiedades
        ]);
    }

    public static function nosotros(Router $router){
        $router ->render("paginas/nosotros", [

        ]);
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();

        $router->render("paginas/propiedades", [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router){
        $id = validarOredireccionar('/');

        $propiedad = Propiedad::find($id);

        $router->render("paginas/propiedad", [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        $router->render("paginas/blog", [
            
        ]);
    }

    public static function contacto(Router $router){
        $mensaje = null;
            
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $respuestas = $_POST['contacto'];
            
            

            $mail = new PHPMailer(true);
            //configurar SMTP o Host
            $mail ->isSMTP();
            $mail ->Host= 'smtp.mailtrap.io';
            $mail ->SMTPAuth = true;
            $mail ->Username = '6988b82d3299bf';
            $mail ->Password= '4004e43e8d317c';
            $mail ->SMTPSecure = 'tls';
            $mail ->Port=2525;


            //configurar el contenido del correo
            $mail ->setFrom('bienesRaices@bienesRaices.com');
            $mail ->addAddress('bienesRaices@bienesRaices.com', "BienesRaices.com");
            $mail ->Subject = "Tienes un nuevo mensaje";

            //Habilitar HTML
            $mail->isHtml(true);
            $mail->CharSet = 'UTF-8';
            //definir el contenido
            $contenido = "Tienes un nuevo mensaje";
            $contenido .= "Nombre: ". $respuestas['nombre'];
            
            
            $contenido .= "Mensaje: ". $respuestas['mensaje'];
            $contenido .= "Vende o compra: ". $respuestas['opciones'];

            if($respuestas['contactar']=== 'telefono'){
                $contenido .= "Eligio ser contactado por email";
                $contenido .= "Telefono: ". $respuestas['telefono'];
                $contenido .= "Fecha de contacto: ". $respuestas['fecha-contactar'];
                $contenido .= "Hora de contacto: ". $respuestas['hora-contactar'];
            }else{
                $contenido .= "Eligio ser contactado por email";
                $contenido .= "Email: ". $respuestas['email'];
            }
            $contenido .= "Prefiere ser contactado por: ". $respuestas['contactar'];
            $contenido .= "Precio o presupuesto: ". $respuestas['presupuesto'];

            $mail->Body=$contenido;

            //Enviar el correo
            if ($mail->send()) {
                $mensaje = "Correo enviado correctamente";
            } else {
                $mensaje = "No se pudo enviar el correo";
            }
        }

        $router->render("paginas/contacto", [
            'mensaje' => $mensaje
        ]);
    }

}