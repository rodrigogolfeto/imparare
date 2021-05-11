<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
include_once("classes/conexao.php");
include_once("includes/funcoes.php");
session_start();
$conexao = new Conexao();

if($_GET['ID']==""){
	$id = 0;
}else{
	$id = $_GET['ID'];
}

if($_POST['CHAVE']==""){
	$chave = 0;
}else{
	$chave = $_POST['CHAVE'];
}

$imagePath 		= "arquivos/imagem/";
$allowedExts 	= array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
$temp 			= explode(".", $_FILES["img"]["name"]);
$extension 		= end($temp);

$_SESSION['imagem_destaque_nome'] = $_FILES["img"]["name"];
$_SESSION['imagem_destaque_tipo'] = $extension;

if(in_array($extension,$allowedExts)){
	if($_FILES["img"]["error"]>0){
		$response = array(
			"status" => 'error',
			"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
		);
		echo "Return Code: " . $_FILES["img"]["error"] . "<br>";
	}else{
		$filename = $_FILES["img"]["tmp_name"];
		list($width, $height) = getimagesize( $filename );
			
		$consulta = $conexao->consulta("SELECT * FROM tag3_imagens WHERE imag_chave='".$chave."'");
		$tot = $conexao->conta($consulta);
		if($tot==0){
			$consulta = $conexao->consulta("INSERT INTO tag3_imagens SET imag_chave='".$chave."', imag_text_id='".$id."', imag_legenda='', imag_descricao='', imag_arquivo='dest_".$chave.".".$_SESSION['imagem_destaque_tipo']."'");
		}else{
			$reg_img = $conexao->busca($consulta);
			$_SESSION['imagem_anterior_banco'] = $reg_img['imag_arquivo'];
			$consulta = $conexao->consulta("UPDATE tag3_imagens SET imag_arquivo='dest_".$chave.".".$_SESSION['imagem_destaque_tipo']."' WHERE imag_chave='".$chave."'");
		}
			
		copy($filename,  $imagePath . $_FILES["img"]["name"]);
		  
		//copy($filename,  $imagePath . "m_".$_FILES["img"]["name"]);

		$nome_arquivo = $_FILES["img"]["name"];
		$response = array(
			"status" => 'success',
			"url" => $imagePath.$nome_arquivo,
			"width" => $width,
			"height" => $height
		);
	}
}else{
	$response = array(
		"status" => 'error',
		"message" => 'something went wrong',
	);
}
	  
print json_encode($response);

/*
$name = 'img_save_to_file_'.date('d').date('m').date('Y').'.txt';
$text = var_export($_REQUEST, true).$response;
$file = fopen($name, 'a');
fwrite($file, $text);
fclose($file);
*/

?>
