<?php

/*

Uploadify

Copyright (c) 2012 Reactive Apps, Ronnie Garcia

Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 

*/

include_once("classes/conexao.php");

include_once("includes/funcoes.php");



$conexao = new Conexao();

// Define a destination

$targetFolder = '/arquivos/galeria/'; // Relative to the root



if (!empty($_FILES)) {

	 if($_POST['ID']==""){

	 	$id = 0;

	 }else{

	 	$id = $_POST['ID'];

	 }

	 if($_POST['CHAVE']==""){

	 	$chave = 0;

	 }else{

	 	$chave = $_POST['CHAVE'];

	 }

	

	// Validate the file type

	$fileTypes = array('jpg','jpeg' ); // File extensions

	$fileParts = pathinfo($_FILES['Filedata']['name']);

	$nome_arquivo = $fileParts['filename'];

	$nome_arquivo = rand(100, 999).slug($nome_arquivo);

	

	if (in_array(strtolower($fileParts['extension']),$fileTypes)) {

		$consulta = $conexao->consulta("INSERT INTO tag3_galeria SET foto_chave='".$chave."', foto_text_id='".$id."', foto_nome='".$nome_arquivo."', foto_tipo='".strtolower($fileParts['extension'])."'");

		$tempFile = $_FILES['Filedata']['tmp_name'];

		$targetFile = 'arquivos/galeria/' . $nome_arquivo.'.'.strtolower($fileParts['extension']);		

		move_uploaded_file($tempFile,$targetFile);

		//

		$largura = 90;

		$altura = 90;

		$img = $targetFile;

		$novo = "thumb_".$nome_arquivo.'.'.strtolower($fileParts['extension']);

		$x0 = $largura;

		$y0 = $altura;			

		list($x, $y, $type, $attr) = getimagesize($img);			

		$checaaltura = ($x0/$x)*$y;

		$checalargura = ($y0/$y)*$x;			

		if($checaaltura > $y0){

			$nova_largura = $x0;

			$nova_altura = $checaaltura;				

		}else{

			$nova_largura = $checalargura;

			$nova_altura = $y0;

		}

		//arqui gerou o thumb

		gera_imagem_galeria($img,$novo,$largura,$altura,$nova_largura,$nova_altura,$pb);

		//

		$largura = 300;

		$altura = 193;

		$img = $targetFile;

		$novo = "medio_".$nome_arquivo.'.'.strtolower($fileParts['extension']);

		$x0 = $largura;

		$y0 = $altura;			

		list($x, $y, $type, $attr) = getimagesize($img);			

		$checaaltura = ($x0/$x)*$y;

		$checalargura = ($y0/$y)*$x;			

		if($checaaltura > $y0){

			$nova_largura = $x0;

			$nova_altura = $checaaltura;				

		}else{

			$nova_largura = $checalargura;

			$nova_altura = $y0;

		}

		//arqui gerou o thumb

		gera_imagem_galeria($img,$novo,$largura,$altura,$nova_largura,$nova_altura,$pb);

		//

		echo '1';

	} else {

		echo 'Tipo de arquivo inválido.';

	}

}

?>