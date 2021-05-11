<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$html="";
$nome = $_POST['ARQUIVO'];
$id = $_POST['ID'];
$nome = utf8_decode($nome);
$consulta = $conexao->consulta("SELECT arqu_nome, arqu_tipo FROM tag3_arquivos WHERE arqu_id=".$id); 
$reg = $conexao->busca($consulta);

$consulta = $conexao->consulta("UPDATE tag3_arquivos SET arqu_nome='".slug($nome)."' WHERE arqu_id=".$id); 
rename("../arquivos/download/".$reg[0].".".$reg[1], "../arquivos/download/".slug($nome).".".$reg[1]);
echo slug($nome).".".$reg[1];
?>