<?php
include_once("../classes/conexao.php");
include_once("../includes/funcoes.php");
$conexao = new Conexao();

$men = $_POST["MENU"];
$submen = $_POST["SUBMENU"];
$cat = $_POST["IDCATEGORIA"];
$id = $_POST["IDTEXTO"];
$stat = $_POST["STAT"];
$busca = $_POST["BUSCA"];
$pag = $_POST["PAGINA"];
$limite = $_POST["LIMITE"];

$medidas = strval($cat);
$med = explode('.',$medidas);
$men1 = $med[0];
$submen1 = intval($med[1]);

$filtro='';
if($stat=='a'){
	$filtro = " AND text_status=1";
}else if($stat=='i'){
	$filtro = " AND text_status=0";
}else{
	$filtro = '';
}
if($busca!='0'){
	$filtro .= ' AND (text_titulo like "%'.addslashes($busca).'%" or text_resumo like "%'.addslashes($busca).'%" or text_texto like "%'.addslashes($busca).'%" or text_texto2 like "%'.addslashes($busca).'%" or text_texto3 like "%'.addslashes($busca).'%" or text_texto4 like "%'.addslashes($busca).'%" or text_texto5 like "%'.addslashes($busca).'%" or text_tags like "%'.addslashes($busca).'%" or text_info1 like "%'.addslashes($busca).'%" or text_info2 like "%'.addslashes($busca).'%" or text_info3 like "%'.addslashes($busca).'%" or text_info4 like "%'.addslashes($busca).'%" or text_info5 like "%'.addslashes($busca).'%")';
}


if($cat>0){
	//$id = addslashes($cat);
	$idtext = addslashes($id);
	//$idcate = addslashes($cat);
	$sql = "SELECT count(*) AS total FROM tag3_relacionamentos, tag3_textos WHERE ((rela_pai=$idtext and rela_filho=text_id) OR (rela_filho=$idtext and rela_pai=text_id)) and text_menu_id=$men1 and text_subm_id=$submen1 $filtro";
}else{
	$sql = "SELECT count(*) AS total FROM tag3_textos WHERE text_menu_id=$men AND text_subm_id=$submen $filtro";
}

$consulta = $conexao->consulta($sql); 
$reg = $conexao->busca($consulta);
$total = $reg['total'];

$num_paginas = ceil($total/$limite);

$html = '<span style="margin-right:10px;"><i>'.$total.' itens</i></span>';
if($pag==1){
	$html .= '<a href="javascript:;" class="primeiro desativado"></a>';
}else{
	$html .= '<a href="?men='.$men.'&submen='.$submen.'&idtex='.$id.'&idcat='.$cat.'&s='.$stat.'&pag=1" class="primeiro"></a>';
}

if($pag==1){
	$html .= '<a href="javascript:;" class="anterior desativado"></a>';
}else{
	$html .= '<a href="?men='.$men.'&submen='.$submen.'&idtex='.$id.'&idcat='.$cat.'&s='.$stat.'&b='.$busca.'&pag='.($pag-1).'" class="anterior "></a>';
}
$html .= '<select onchange="window.open(\'?men='.$men.'&submen='.$submen.'&idtex='.$id.'&idcat='.$cat.'&b='.$busca.'&s='.$stat.'&pag=\'+this.value,\'_self\')" >';
for($i=1;$i<=$num_paginas;$i++){          
	$html .= '<option value="'.$i.'"';
	if($i==$pag){
		$html .= ' selected="selected"';
	}
	$html .= '>'.$i.'</option>';
}
$html .= '</select>';
//$html .= '<input type="text" value="'.$pag.'" id="campoPagina" name="campoPagina" />';
$html .= '<span>de '.$num_paginas.'</span>';
if($num_paginas==$pag){
	$html .= '<a href="javascript:;" class="proximo desativado"></a>';
}else{
	$html .= '<a href="?men='.$men.'&submen='.$submen.'&idtex='.$id.'&idcat='.$cat.'&s='.$stat.'&b='.$busca.'&pag='.($pag+1).'" class="proximo"></a>';
}

if($num_paginas==$pag){
	$html .= '<a href="javascript:;" class="ultimo desativado"></a>';
}else{
	$html .= '<a href="?men='.$men.'&submen='.$submen.'&idtex='.$id.'&idcat='.$cat.'&s='.$stat.'&b='.$busca.'&pag='.($num_paginas).'" class="ultimo"></a>';
}
echo $html;

?>