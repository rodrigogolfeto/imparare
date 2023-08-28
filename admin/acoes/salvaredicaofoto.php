<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$html="";
$nome = $_POST['ARQUIVO'];
$id = $_POST['ID'];
$nome = $nome;
$consulta = $conexao->consulta("UPDATE tag3_galeria SET foto_legenda='".$nome."' WHERE foto_id=".$id); 
echo $nome;
?>