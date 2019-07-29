<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r                   = array();
$tipo                = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$id                  = isset($_POST['pkID']) ? $_POST['pkID'] : "";
$fecha               = isset($_POST['fecha']) ? $_POST['fecha'] : "";
$fecha_doc           = isset($_POST['fecha_doc']) ? $_POST['fecha_doc'] : "";
$descripcion         = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$file                = isset($_POST['file']) ? $_POST['file'] : "";
$fkID_proyecto_marco = isset($_POST['fkID_proyecto_marco']) ? $_POST['fkID_proyecto_marco'] : "";
$nombre              = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$cantidad            = isset($_POST['cantidad']) ? $_POST['cantidad'] : "";
$fkID_aibd           = isset($_POST['fkID_aibd']) ? $_POST['fkID_aibd'] : "";

switch ($tipo) {
    case 'crear':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreImg = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreImg = str_replace(" ", "_", $nombreImg);
            $nombreImg = str_replace("%", "_", $nombreImg);
            $nombreImg = str_replace("-", "_", $nombreImg);
            $nombreImg = str_replace(";", "_", $nombreImg);
            $nombreImg = str_replace("#", "_", $nombreImg);
            $nombreImg = str_replace("!", "_", $nombreImg);
            //carga el archivo en el servidor
            $destinoImg = "../server/php/files/" . $nombreImg;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoImg);
        } else {
            $nombreImg = '';
        }

        $q_inserta  = "INSERT INTO aibd (fecha, descripcion, url_imagen, fkID_proyecto_marco) VALUES ('$fecha', '$descripcion','$nombreImg' , '$fkID_proyecto_marco')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'editar':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreImg = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreImg = str_replace(" ", "_", $nombreImg);
            $nombreImg = str_replace("%", "_", $nombreImg);
            $nombreImg = str_replace("-", "_", $nombreImg);
            $nombreImg = str_replace(";", "_", $nombreImg);
            $nombreImg = str_replace("#", "_", $nombreImg);
            $nombreImg = str_replace("!", "_", $nombreImg);
            //carga el archivo en el servidor
            $destinoImg = "../server/php/files/" . $nombreImg;
            $imagen     = ",url_imagen = '" . $nombreImg . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoImg);
        } else {
            $imagen = '';
        }

        $q_inserta  = "UPDATE aibd SET fecha ='$fecha',descripcion='$descripcion'" . $imagen . " WHERE pkID='$id'";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'eliminararchivoimagen':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE aibd SET url_imagen='' where pkID='$id' ";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {
            $r[] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }

        break;
    case 'eliminararchivodocumento':
        $generico   = new Generico_DAO();
        $q_inserta  = "UPDATE documentos_aibd SET url_documento='' where pkID='$id' ";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {
            $r[] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }

        break;
    case 'crear_documento':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreDoc = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $nombreDoc = str_replace("%", "_", $nombreDoc);
            $nombreDoc = str_replace("-", "_", $nombreDoc);
            $nombreDoc = str_replace(";", "_", $nombreDoc);
            $nombreDoc = str_replace("#", "_", $nombreDoc);
            $nombreDoc = str_replace("!", "_", $nombreDoc);
            //carga el archivo en el servidor
            $destinoDoc = "../server/php/files/" . $nombreDoc;

            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);
        } else {
            $nombreDoc = '';
        }
        $generico   = new Generico_DAO();
        $q_inserta  = "INSERT INTO documentos_aibd (fecha_doc, nombre, url_documento,fkID_proyecto_marco) VALUES ('$fecha_doc', '$nombre','$nombreDoc' , '$fkID_proyecto_marco')";
        $r["query"] = $q_inserta;

        $resultado = $generico->EjecutaInsertar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'editar_documento':
        $generico = new Generico_DAO();
        if (isset($_FILES['file']["name"])) {
            $nombreDoc = $_FILES['file']["name"];
            //Reemplaza los caracteres especiales por guiones al piso
            $nombreDoc = str_replace(" ", "_", $nombreDoc);
            $nombreDoc = str_replace("%", "_", $nombreDoc);
            $nombreDoc = str_replace("-", "_", $nombreDoc);
            $nombreDoc = str_replace(";", "_", $nombreDoc);
            $nombreDoc = str_replace("#", "_", $nombreDoc);
            $nombreDoc = str_replace("!", "_", $nombreDoc);
            //carga el archivo en el servidor
            $destinoDoc = "../server/php/files/" . $nombreDoc;
            $documento  = ",url_documento = '" . $nombreDoc . "'";
            move_uploaded_file($_FILES['file']["tmp_name"], $destinoDoc);
        } else {
            $documento = '';
        }

        $q_inserta  = "UPDATE documentos_aibd SET fecha_doc ='$fecha_doc',nombre='$nombre'" . $documento . " WHERE pkID='$id'";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {

            $r[] = $resultado;

        } else {

            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    default:
        # code...
        break;
}

echo json_encode($r);
