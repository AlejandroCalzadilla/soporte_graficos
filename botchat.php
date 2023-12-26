
<?php

function preguntaChatgpt($pregunta){
    //API KEY DE CHATGPT
    $apiKey='apikey';
    //INICIAMOS LA CONSULTA DE CURL
    //$mensajeAdicional = "realiza un analisis de sentimientos a la  linea siguiente , devuelmeme una cadena asi: positivo,negativo o neutro.....  ,no muestres el contenido de la //linea :";
    //$pregunta=$mensajeAdicional+$pregunta;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer '.$apiKey,
    ]);

    //$pregunta = "AQUÍ VA LA PREGUNTA";  // Asegúrate de definir la variable $pregunta antes de usarla
    
    $mensaje = "Realiza un análisis de sentimientos del siguiente mensaje y devuélveme una cadena que solo diga si es positivo, neutro o negativo. No muestres el contenido del mensaje." . $pregunta;
    
    
    //INICIAMOS EL JSON QUE SE ENVIARA A META
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{
        \"model\": \"text-davinci-003\",
        \"prompt\": \"".$mensaje."\",
        \"max_tokens\": 10,
        \"temperature\": 1.0
    }");
    


    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //OBTENEMOS EL JSON COMPLETO CON LA RESPUESTA
    $response = curl_exec($ch);
    echo($response);
    curl_close($ch);
    $decoded_json = json_decode($response, false);
    //echo( $decoded_json);
    //RETORNAMOS LA RESPUESTA QUE EXTRAEMOS DEL JSON
    return  $decoded_json->choices[0]->text;    
}



 // preguntaChatgpt("cuanto es 6 +6 ");


    // Resto del código...
  
    


