<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$id = $_POST['ID'];
$status = $_POST['STATUS'];
$consulta = $conexao->consulta("UPDATE tag3_textos SET text_destaque = ".$status." WHERE text_id=".$id);
?>