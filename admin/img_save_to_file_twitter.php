<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
	include_once("classes/conexao.php");
	include_once("includes/funcoes.php");
	
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

	
	$imagePath = "arquivos/imagem/";

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);

	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);
			echo "Return Code: " . $_FILES["img"]["error"] . "<br>";
		}
	  else
		{
			
		  $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );
			
			$consulta = $conexao->consulta("SELECT * FROM tag3_seo WHERE seo_chave='".$CHAVE."'");
			$tot = $conexao->conta($consulta);
			if($tot==0){
				$consulta = $conexao->consulta("INSERT INTO tag3_seo SET seo_chave='".$CHAVE."', seo_text_id='".$ID."', seo_twitter_imagem='tw_".$CHAVE.".jpg'");
			}else{
				$consulta = $conexao->consulta("UPDATE tag3_seo SET seo_twitter_imagem='tw_".$CHAVE.".jpg' WHERE seo_chave='".$CHAVE."'");
			}
			
		  move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);
		  

		  $nome_arquivo = $_FILES["img"]["name"];
		  $response = array(
			"status" => 'success',
			"url" => $imagePath.$nome_arquivo,
			"width" => $width,
			"height" => $height
		  );
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'something went wrong',
		);
	  }
	  
	  print json_encode($response);

?>
