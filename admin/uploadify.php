<?php
 ini_set('default_charset','UTF-8');
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
include_once("classes/conexao.php");
include_once("includes/funcoes.php");
$conexao = new Conexao();
// Define a destination
$targetFolder = '/arquivos/download/'; // Relative to the root

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
	$fileTypes = array('jpg','jpeg','gif','png','doc','docx','xls','xlsx','pdf','mp3','mp4' ); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);	
	$nome_arquivo = $fileParts['filename'];
	$nome_arquivo = slug($nome_arquivo);
	if (in_array(strtolower($fileParts['extension']),$fileTypes)) {
		$consulta = $conexao->consulta("INSERT INTO tag3_arquivos SET arqu_data=now(), arqu_chave='".$chave."', arqu_text_id='".$id."', arqu_nome='".$nome_arquivo."', arqu_tipo='".strtolower($fileParts['extension'])."'");
		$tempFile = $_FILES['Filedata']['tmp_name'];
		$targetFile = 'arquivos/download/' . $nome_arquivo.'.'.strtolower($fileParts['extension']);
		move_uploaded_file($tempFile,$targetFile);
		//echo $targetFolder . '/' . $_FILES['Filedata']['name'];;
		echo '1';
	} else {
		echo 'Tipo de arquivo inválido.';
	}
}
?>