<?php 

require_once "./model/Conexion.php";
$db = Conexion::Conectar();
/*function format_uri( $string, $separator = '-' )
{
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
}*/


if(isset($_GET["op"]) and $_GET["op"]=="Registro"){
	
	if (!empty($_FILES["txtImagen"]["tmp_name"])) {
			$textura = $_FILES['txtImagen']['name']; 
			$iFileType = pathinfo($textura,PATHINFO_EXTENSION);
			$file_array2 = explode(".", $textura);
			$limpia=date("Y").rand(10,99999);
			$imagen = $limpia.'.'.$iFileType;
			$ruta = './web/images_productos/'.$imagen;
			//maximo
			$stmt = $db->prepare("SELECT MAX(idproducto) AS id FROM producto");
			$stmt -> execute();
			$maxi = $stmt->fetch();
			$max_id = $maxi['id'];

	if (move_uploaded_file($_FILES['txtImagen']['tmp_name'], $ruta)) {
    $query = $db->prepare("UPDATE producto SET `imagen`=:imagen where idproducto = :id");
	$query -> bindParam(":imagen", $imagen);
	$query -> bindParam(":id", $max_id);
	$query->execute();
	}


	}
}elseif(isset($_GET["op"]) and $_GET["op"]=="Edicion"){
		if (!empty($_FILES["txtImagen"]["tmp_name"])) {
			$textura = $_FILES['txtImagen']['name']; 
			$iFileType = pathinfo($textura,PATHINFO_EXTENSION);
			$file_array2 = explode(".", $textura);
			$limpia=date("Y").rand(10,99999);
			$imagen = $limpia.'.'.$iFileType;
			$ruta = './web/images_productos/'.$imagen;
/*txtID*/
			//Borramos archivo anterior
			if(!empty($_POST["cimagen"])){
			$nombre_fichero = 'web/images_productos/'.$_POST["cimagen"];
			  if (file_exists($nombre_fichero)) {
				   unlink('web/images_productos/'.$_POST["cimagen"]);
			  } 
			}

if (move_uploaded_file($_FILES['txtImagen']['tmp_name'], $ruta)) {

    $query = $db->prepare("UPDATE producto SET `imagen`=:imagen where idproducto = :id");
	$query -> bindParam(":imagen", $imagen);
	$query -> bindParam(":id", $_POST["txtID"]);
	$query->execute();
}

	   }
}
if(isset($_GET["user"]) and $_GET["user"]=="Registro"){
	
	if (!empty($_FILES["txtImagen"]["tmp_name"])) {
		
			$textura = $_FILES['txtImagen']['name']; 
			$iFileType = pathinfo($textura,PATHINFO_EXTENSION);
			$file_array2 = explode(".", $textura);
			$limpia=date("Y").rand(10,99999);
			$imagen = $limpia.'.'.$iFileType;
			$ruta = './web/images_user/'.$imagen;
			//maximo
			$stmt = $db->prepare("SELECT MAX(idempleado) AS id FROM empleado");
			$stmt -> execute();
			$maxi = $stmt->fetch();
			$max_id = $maxi['id'];

			if (move_uploaded_file($_FILES['txtImagen']['tmp_name'], $ruta)) {
			$query = $db->prepare("UPDATE empleado  SET `imagen`=:imagen where idempleado = :id");
			$query -> bindParam(":imagen", $imagen);
			$query -> bindParam(":id", $max_id);
			$query->execute();
			}
	
	}
}elseif(isset($_GET["user"]) and $_GET["user"]=="Edicion"){
		if (!empty($_FILES["txtImagen"]["tmp_name"])) {
			$textura = $_FILES['txtImagen']['name']; 
			$iFileType = pathinfo($textura,PATHINFO_EXTENSION);
			$file_array2 = explode(".", $textura);
			$limpia=date("Y").rand(10,99999);
			$imagen = $limpia.'.'.$iFileType;
			$ruta = './web/images_user/'.$imagen;

			if (move_uploaded_file($_FILES['txtImagen']['tmp_name'], $ruta)) {
			$query = $db->prepare("UPDATE empleado  SET `imagen`=:imagen where idempleado = :id");
			$query -> bindParam(":imagen", $imagen);
			$query -> bindParam(":id", $_POST["txtID"]);
			$query->execute();
			}

			//Borramos archivo anterior
		    if(!empty($_POST["cimagen"])){
			  $nombre_fichero = 'web/images_user/'.$_POST["cimagen"];
			  if (file_exists($nombre_fichero)) {
				   unlink('web/images_user/'.$_POST["cimagen"]);
			  } 
			}
	   }
}
?>