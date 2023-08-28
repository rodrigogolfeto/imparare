<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$valores = $_POST['VALORES'];
$array = explode(',',$valores);
$registros = count($array);
for($i=0;$i<$registros; $i++){
	$consulta = $conexao->consulta("DELETE FROM tag3_textos WHERE text_id=".$array[$i]);
	$consulta = $conexao->consulta("DELETE FROM tag3_relacionamentos WHERE rela_pai=".$array[$i]." OR rela_filho=".$array[$i]);
	$consulta = $conexao->consulta("DELETE FROM tag3_seo WHERE rela_pai=".$array[$i]." OR rela_filho=".$array[$i]);
	$consulta = $conexao->consulta("DELETE FROM tag3_galeria WHERE foto_text_id=".$array[$i]);
	$consulta = $conexao->consulta("DELETE FROM tag3_imagens WHERE imag_text_id=".$array[$i]);
	$consulta = $conexao->consulta("DELETE FROM tag3_arquivos WHERE arqu_text_id=".$array[$i]);
	//voltar aqui e apagar imagens, arquivos, tudo o que tiver atrelado a essas ids
}


?>