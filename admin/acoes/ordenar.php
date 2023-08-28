<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$html="";
$valores = $_POST['VALORES'];
$array = explode(',',$valores);
$registros = count($array);
for($i=0;$i<$registros; $i++){
	$consulta = $conexao->consulta("UPDATE tag3_textos SET text_ordem = ".$i." WHERE text_id=".$array[$i]);
}
//CONTAR QUANTOS REGISTROS TEM NO TOTAL
$consulta = $conexao->consulta("SELECT text_id FROM tag3_textos");
$total = $conexao->conta($consulta);

$consulta = $conexao->consulta("SELECT text_id FROM tag3_textos ORDER BY text_ordem ASC LIMIT $registros, $total-$registros");
$i = $registros;
while($reg = $conexao->busca($consulta)){
	$consulta = $conexao->consulta("UPDATE tag3_textos SET text_ordem = ".$i." WHERE text_id=".$reg['text_id']);
	$i++;
}

?>