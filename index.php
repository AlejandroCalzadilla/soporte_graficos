<?php
//Codigo para Recibir WhatsApp y crear una respuesta con ChatGPT en PHP
/*
 * VERIFICACION DEL WEBHOOK
*/
//TOQUEN QUE QUERRAMOS PONER 
$token = 'ale';
//RETO QUE RECIBIREMOS DE FACEBOOK
$palabraReto = $_GET['hub_challenge'];
//TOQUEN DE VERIFICACION QUE RECIBIREMOS DE FACEBOOK
$tokenVerificacion = $_GET['hub_verify_token'];
//SI EL TOKEN QUE GENERAMOS ES EL MISMO QUE NOS ENVIA FACEBOOK RETORNAMOS EL RETO PARA VALIDAR QUE SOMOS NOSOTROS
if ($token === $tokenVerificacion) {
    echo $palabraReto;
    exit;
}

/*
 * RECEPCION DE MENSAJES
 */
//LEEMOS LOS DATOS ENVIADOS POR WHATSAPP
$respuesta = file_get_contents("php://input");
//CONVERTIMOS EL JSON EN ARRAY DE PHP
$respuesta = json_decode($respuesta, true);
//EXTRAEMOS EL MENSAJE DEL ARRAY
$mensaje=$respuesta['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
//EXTRAEMOS EL TELEFONO DEL ARRAY
$telefonoCliente=$respuesta['entry'][0]['changes'][0]['value']['messages'][0]['from'];
//EXTRAEMOS EL ID DE WHATSAPP DEL ARRAY
$id=$respuesta['entry'][0]['changes'][0]['value']['messages'][0]['id'];
//EXTRAEMOS EL TIEMPO DE WHATSAPP DEL ARRAY
$timestamp=$respuesta['entry'][0]['changes'][0]['value']['messages'][0]['timestamp'];
//SI HAY UN MENSAJE
if($mensaje!=null){
    require_once "botchat.php";   
    $contenido = $mensaje . ' ' . $telefonoCliente;
    // Abrir el archivo en modo de añadir (FILE_APPEND)
    file_put_contents("text.txt", $mensaje . PHP_EOL , FILE_APPEND);
     //file_put_contents("text.txt", $contenido . PHP_EOL, FILE_APPEND); 
     $respuesta=preguntaChatgpt($mensaje);
     //print($respuesta);
    //ESCRIBIMOS LA RESPUESTA
     file_put_contents("text.txt", $respuesta . PHP_EOL, FILE_APPEND);
    require_once "envia.php";
    //ENVIAMOS LA RESPUESTA VIA WHATSAPP    
    enviar($mensaje,$respuesta,$id,$timestamp,$telefonoCliente);

}



