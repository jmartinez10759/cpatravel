<?php

namespace App\Http\Controllers\Apirest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurlRequestController extends Controller
{
    

	public function sendPost($url= false, $data = array() )
	{
		//datos a enviar
		$data = array("a" => "a");
		//url contra la que atacamos
		$ch = curl_init("http://localhost/curlRequest/api.php");
		//a true, obtendremos una respuesta de la url, en otro caso, 
		//true si es correcto, false si no lo es
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		//enviamos el array data
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		//obtenemos la respuesta
		$response = curl_exec($ch);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
		if(!$response) {
		    return false;
		}else{
			var_dump($response);
		}
	}

	public function sendPut()
	{
		//datos a enviar
		$data = array("a" => "a");
		//url contra la que atacamos
		$ch = curl_init("http://localhost/curlRequest/api.php");
		//a true, obtendremos una respuesta de la url, en otro caso, 
		//true si es correcto, false si no lo es
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		//enviamos el array data
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		//obtenemos la respuesta
		$response = curl_exec($ch);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
		if(!$response) {
		    return false;
		}else{
			var_dump($response);
		}
	}

	public function sendGet( $url = false, $data = false,$id_usuario = false, $token=false )
	{
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		      CURLOPT_URL             => $url,
		      CURLOPT_RETURNTRANSFER  => true,         // return web page
		      CURLOPT_ENCODING        => "",           // handle all encodings
		      CURLOPT_MAXREDIRS       => 10,           // stop after 10 redirects
		      CURLOPT_TIMEOUT         => 120,
		      CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
		      CURLOPT_CUSTOMREQUEST   => "GET",
		      CURLOPT_SSL_VERIFYHOST  => 0,
		      CURLOPT_SSL_VERIFYPEER  => 0,
		      CURLOPT_POSTFIELDS      => $data,    // this are my post vars
		      CURLOPT_HTTPHEADER      => array(
		        'Content-Type: application/json',
		        'Content-Length: '.strlen($data),
		        'usuario: '.$id_usuario,
		        'token: '.$token
		      )
		));
		$response = curl_exec($curl);
		$error = curl_error($curl);
		curl_close($curl);
		if ($error) {
		  return "cURL Error #: ".$error;
		}else {
		  return $response;
		}

	}

	public function sendDelete()
	{
		//datos a enviar
		$data = array("a" => "a");
		//url contra la que atacamos
		$ch = curl_init("http://localhost/curlRequest/api.php");
		//a true, obtendremos una respuesta de la url, en otro caso, 
		//true si es correcto, false si no lo es
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		//enviamos el array data
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		//obtenemos la respuesta
		$response = curl_exec($ch);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
		if(!$response) {
		    return false;
		}else{
			var_dump($response);
		}
	}



}
