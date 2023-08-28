<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$id = $_POST['ID'];
$consulta = $conexao->consulta("SELECT * FROM tag3_arquivos WHERE arqu_id=".$id);
$reg = $conexao->busca($consulta);
unlink("../arquivos/download/".$reg['arqu_nome'].".".$reg['arqu_tipo']);
$consulta2 = $conexao->consulta("DELETE FROM tag3_arquivos WHERE arqu_id=".$id);
?>