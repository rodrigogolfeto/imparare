<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$id = $_POST['ID'];
$sql = "DELETE FROM tag3_textos WHERE text_id=".$id;
$consulta = $conexao->consulta($sql);

//--------VERIFICA SE TEM ARQUIVOS ATRELADOS AO TEXTO E EXCLUI-------------
$sql = "SELECT * FROM tag3_arquivos WHERE arqu_text_id=".$id;
$consulta = $conexao->consulta($sql);
while($reg = $conexao->busca($consulta)){
	if(file_exists("../arquivos/download/".$reg['arqu_nome'].".".$reg['arqu_tipo'])){
		unlink("../arquivos/download/".$reg['arqu_nome'].".".$reg['arqu_tipo']);
	}
}
$sql = "DELETE FROM tag3_arquivos WHERE arqu_text_id=".$id;
$consulta = $conexao->consulta($sql);
//--------FIM VEFIFICAÇÃO E EXCLUSÃO DE ARQUIVOS----------------------------


//--------VERIFICA SE TEM IMAGENS GALERIA ATRELADAS AO TEXTO E EXCLUI-------
$sql = "SELECT * FROM tag3_galeria WHERE foto_text_id=".$id;
$consulta = $conexao->consulta($sql);
while($reg = $conexao->busca($consulta)){
	if(file_exists("../arquivos/galeria/".$reg['foto_nome'].".".$reg['foto_tipo'])){
		unlink("../arquivos/galeria/".$reg['foto_nome'].".".$reg['foto_tipo']);
	}
}
$sql = "DELETE FROM tag3_galeria WHERE foto_text_id=".$id;
$consulta = $conexao->consulta($sql);
//--------FIM VEFIFICAÇÃO E EXCLUSÃO DE IMAGENS GALERIA---------------------


//--------VERIFICA SE TEM IMAGENS DESTAQUES ATRELADAS AO TEXTO E EXCLUI-------
$sql = "SELECT * FROM tag3_imagens WHERE imag_text_id=".$id;
$consulta = $conexao->consulta($sql);
while($reg = $conexao->busca($consulta)){
	if(file_exists("../arquivos/imagem/".$reg['imag_arquivo'])){
		unlink("../arquivos/imagem/".$reg['imag_arquivo']);
	}
}
$sql = "DELETE FROM tag3_imagens WHERE imag_text_id=".$id;
$consulta = $conexao->consulta($sql);
//--------FIM VEFIFICAÇÃO E EXCLUSÃO DE IMAGENS DESTAQUES--------------------


?>