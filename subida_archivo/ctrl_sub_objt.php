<?php

	header('Content-type: application/json');
	

	include("php_subida_objt.php");
    include("../Conexion/datos.php");

	//$va_para = '/var/www/html/lunel_ie_manager/vistas/subidas/';

    $va_para = $ruta_server;

	//print_r($_FILES['archivo']);
    /**/
	if( isset($_FILES['archivo']) ){

		$subida = new sube_imagen($_FILES["archivo"],$va_para);

		//$subida->asigna_val();

		//print_r($subida->subir());

		echo json_encode($respuesta = $subida->subir());

		//echo "<img src='".$respuesta["src"]."'>"; 
	}elseif (isset($_FILES['file'])) {
        # code...

        $subida = new sube_imagen($_FILES["file"],$va_para);

        //$subida->asigna_val();

        //print_r($subida->subir());

        echo json_encode($respuesta = $subida->subir());

    }else{

		$mensaje = array('mensaje' => "No existe ningún archivo para subir.");

		echo json_encode($mensaje);
	}; 

	

/*
	$mensaje = array();

	# definimos la carpeta destino
    $carpetaDestino='/var/www/html/lunelAdmin/vistas/subidas/';
 
    # si hay algun archivo que subir
    if($_FILES["archivo"]["name"][0])
    {
 
        # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
        {
 
            # si es un formato de imagen
            if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png" || $_FILES["archivo"]["type"][$i]=="application/pdf" || $_FILES["archivo"]["type"][$i]=="application/msword" || $_FILES["archivo"]["type"][$i]=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $_FILES["archivo"]["type"][$i]=="application/octet-stream" )
            {
 
                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {
                    $origen=$_FILES["archivo"]["tmp_name"][$i];
                    $destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
 
                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                        //echo "<br>".$_FILES["archivo"]["name"][$i]." movido correctamente";

                        $elemento = array('nombre' => $_FILES["archivo"]["name"][$i],
			                             'estado' => "Archivo ". $_FILES["archivo"]["name"][$i] ." subido con éxito.",
			                             'src' => 'subidas/'.$_FILES["archivo"]["name"][$i],
			                             'clase' => 'alert alert-success'
                            );
                        
                        array_push($mensaje, $elemento);

                    }else{
                        //echo "<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
                        $elemento = array('mensaje' => 'No se ha podido mover el archivo: '.$_FILES['archivo']['name'][$i],
                                 'estado' => "error",
                                 'tipo' => $_FILES['archivo']['type'][$i],
                                 'clase' => 'alert alert-danger'
                            );

                        array_push($mensaje, $elemento);
                    }
                }else{
                    //echo "<br>No se ha podido crear la carpeta: ".$carpetaDestino;
                    $elemento = array('mensaje' => 'No se ha podido crear la carpeta'.$carpetaDestino,
                                 'estado' => "error",                                 
                                 'clase' => 'alert alert-danger'
                            );

                    array_push($mensaje, $elemento);
                }
            }else{
                //echo "<br>".$_FILES["archivo"]["name"][$i]." - NO está permitido.";
                $elemento = array('mensaje' => 'NO está permitido '.$_FILES["archivo"]["name"][$i],
                                 'tipo' => $_FILES['archivo']['type'][$i],
                                 'estado' => "error",                                 
                                 'clase' => 'alert alert-danger'
                            );

                array_push($mensaje, $elemento);
            }
        }
    }else{
        //echo "<br>No se ha subido ningun archivo.";

        $elemento = array('mensaje' => 'No se ha subido ningún archivo.',
                                 'estado' => "error",                                 
                                 'clase' => 'alert alert-danger'
                            );

                array_push($mensaje, $elemento);
    }

    echo json_encode($mensaje);
*/

 ?>