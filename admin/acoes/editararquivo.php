<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$html="";
$id = $_POST['ID'];
$vetor = explode('/', $id);
$vetor = array_reverse($vetor);
$consulta = $conexao->consulta("SELECT * FROM tag3_arquivos WHERE arqu_id=".$vetor[0]);
$reg = $conexao->busca($consulta); 
echo $reg['arqu_nome']."|".$reg['arqu_id'];

?>