<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$html="";
$valores = $_POST['VALORES'];
$array = explode('|',$valores);
$registros = count($array);
for($i=0;$i<$registros; $i++){
	$consulta = $conexao->consulta("UPDATE tag3_arquivos SET arqu_ordem = ".$i." WHERE arqu_id=".$array[$i]);
}

?>