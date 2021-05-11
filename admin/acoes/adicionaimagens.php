<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$html="";
$id = $_POST['ID'];
$consulta = $conexao->consulta("SELECT * FROM tag3_galeria WHERE foto_chave='".$id."'"); 
while($reg = $conexao->busca($consulta)){
	
	$html .= '<li data-id="'.$reg['foto_id'].'" id="foto'.$reg['foto_id'].'">
                                                	<span>
                                                    	<a href="javascript:;" class="bt bt-editar" data-id="'.$reg['foto_id'].'" data-toggle="modal" data-target="#galeriaModal" title="Editar">Editar</a>
                                                    	<a href="javascript:removerImagemGal('.$reg['foto_id'].');" class="bt bt-excluir" title="Excluir">Excluir</a>
                                                    </span>
                                                    <div><img src="arquivos/galeria/thumb_'.$reg['foto_nome'].'.'.$reg['foto_tipo'].'" width="90" height="90" /></div>
                                                </li>';
}

echo ($html);

?>