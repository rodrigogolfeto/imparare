<?php
include_once("../classes/usuario.php");
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$html="";
$id = $_POST['ID'];
$consulta = $conexao->consulta("SELECT * FROM tag3_arquivos WHERE arqu_chave='".$id."'"); 
while($reg = $conexao->busca($consulta)){
	
	$html .= '<li data-id="'.$reg['arqu_id'].'" id="arq'.$reg['arqu_id'].'" >
                                            	<span>
                                                    <i class="icone '.substr($reg['arqu_tipo'],0,3).'">&nbsp;</i>
                                                    <span id="titArq'.$reg['arqu_id'].'">'.utf8_encode($reg['arqu_nome']).'.'.$reg['arqu_tipo'].'</span>
                                                </span>
                                                <div class="div-acoes">
                                                	<a href="javascript;" data-id="'.$reg['arqu_id'].'" class="bt bt-editar tip" data-toggle="modal" data-target="#arquivoModal" data-placement="left" title="Editar">Editar</a>
                                                    <a href="arquivos/download/'.$reg['arqu_nome'].'.'.$reg['arqu_tipo'].'" id="visuArq'.$reg['arqu_id'].'" target="_blank" class="bt bt-visualizar tip" data-placement="left" title="Visualizar">Visualizar</a>
                                                    <a href="javascript:removerArquivo('.$reg['arqu_id'].');" class="bt bt-excluir tip" data-placement="left" title="Excluir">Excluir</a>                                                    
                                                </div><!-- div-acoes -->
                                            </li>';
}

echo ($html);

?>