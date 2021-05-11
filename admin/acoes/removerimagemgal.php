<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$id = $_POST['ID'];
$consulta = $conexao->consulta("SELECT * FROM tag3_galeria WHERE foto_id=".$id);
$reg = $conexao->busca($consulta);
unlink("../arquivos/galeria/thumb_".$reg['foto_nome'].".".$reg['foto_tipo']);
unlink("../arquivos/galeria/".$reg['foto_nome'].".".$reg['foto_tipo']);
$consulta2 = $conexao->consulta("DELETE FROM tag3_galeria WHERE foto_id=".$id);
?>