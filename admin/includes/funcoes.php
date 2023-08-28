<?php

// mascara pra tudo
function mask($val, $mask){
	$maskared = '';
	$k = 0;
	for($i = 0; $i<=strlen($mask)-1; $i++){
	if($mask[$i] == '#'){
		if(isset($val[$k]))
			$maskared .= $val[$k++];
	}else{
		if(isset($mask[$i]))
			$maskared .= $mask[$i];
	}
	}
	return $maskared;
}

// converte a data
function mostra_data($dt) { 
	$dt=trim($dt);
    $yr=strval(substr($dt,0,4)); 
    $mo=strval(substr($dt,5,2)); 
    $da=strval(substr($dt,8,2)); 
    $hr=strval(substr($dt,11,2)); 
    $mi=strval(substr($dt,14,2)); 
    $se=strval(substr($dt,17,2)); 
    return $da."/".$mo."/".$yr;
}

// converte a hora
function mostra_hora($dt) { 
	$dt=trim($dt);
    $yr=strval(substr($dt,0,2)); 
    $mo=strval(substr($dt,5,2)); 
    $da=strval(substr($dt,8,2)); 
    $hr=strval(substr($dt,11,2)); 
    $mi=strval(substr($dt,14,2)); 
    $se=strval(substr($dt,17,2)); 
     return $hr.":".$mi; 
}

function mostra_hora_simples($dt) { 
	$dt=trim($dt);
    $hr=strval(substr($dt,0,2)); 
    $mi=strval(substr($dt,3,2)); 
    $da=strval(substr($dt,6,2)); 
     return $hr.":".$mi; 
}

function validaHora($hora){
	if(ereg("^([0-1][0-9]|[2][0-3]):[0-5][0-9]$", $hora)){
	  return 1;
	}else{
	  return 0;
	}
}

// mostra parte da hora
function mostra_time_info($dt, $oque) { 
	$dt=trim($dt);
    $yr=strval(substr($dt,0,4)); 
    $mo=strval(substr($dt,5,2)); 
    $da=strval(substr($dt,8,2)); 
    $hr=strval(substr($dt,11,2)); 
    $mi=strval(substr($dt,14,2)); 
    $se=strval(substr($dt,17,2));  
	if($oque=="hora"){
		return $hr; 
	}else if($oque=="minuto"){
    	return $mi;
	}else if($oque=="ano"){
    	return $yr;
	}else if($oque=="mes"){
    	return $mo;
	}else if($oque=="dia"){
    	return $da;
	}
}

// mostra periodo entre duas datas
function mostra_periodo($dt, $dt2) { 
	$dt=trim($dt);
    $yr=strval(substr($dt,0,4)); 
    $mo=strval(substr($dt,5,2)); 
    $da=strval(substr($dt,8,2)); 
	$dt2=trim($dt2);
    $yr2=strval(substr($dt2,0,4)); 
    $mo2=strval(substr($dt2,5,2)); 
    $da2=strval(substr($dt2,8,2)); 
    return $da."/".$mo." a ".$da2."/".$mo2."/".$yr2;
}

/* Converte o TIMESTAMP do Unix para o DATETIME do MySQL
1072834230 -> 2003-12-23 23:30:59 */
function timestamp_para_mysql_datetime($ts) {
	$d=getdate($ts);
	$yr=$d["year"];
	$mo=$d["mon"];
	$da=$d["mday"];
	$hr=$d["hours"];
	$mi=$d["minutes"];
	$se=$d["seconds"];
	return sprintf("%04d-%02d-%02d %02d:%02d:%02d",$yr,$mo,$da,$hr,$mi,$se);
}

function escreveSemanaMes($a, $b){	
	$semana = array("Sun" => "DOM", "Mon" => "SEG", "Tue" => "TER", "Wed" => "QUA", "Thu" => "QUI", "Fri" => "SEX", "Sat" => "SAB");		  
	$mes = array(1=>"JAN", "FEV", "MAR", "ABR", "MAI", "JUN", "JUL", "AGO", "SET", "OUT", "NOV", "DEZ"); 
	if($b=='sem'){
		return $semana[$a];
	}else{
		$a = $a/1;
		return $mes[$a];
	}
}

function escreveData($data)  
{  
	$vardia = substr($data, 8, 2); 
	$varmes = substr($data, 5, 2); 
	$varano = substr($data, 0, 4); 
	
	$convertedia = date ("D", mktime(0,0,0,$varmes,$vardia,$varano)); 
	
	$s = date("D"); /* Mostra 3 primeiras letras do dia da semana em ingles */ 
	
	$semana = array("Sun" => "Domingo", "Mon" => "Segunda-feira", "Tue" => "Ter�a-feira", "Wed" => "Quarta-feira", "Thu" => "Quinta-feira", "Fri" => "Sexta-feira", "Sat" => "S�bado"); /* Dias da Semana. */ 
		  
	$mes = array(1=>"JANEIRO", "FEVEREIRO", "MARCO", "ABRIL", "MAIO", "JUNHO", "JULHO", "AGOSTO", "SETEMBRO", "OUTUBRO", "NOVEMBRO", "DEZEMBRO");  
	if(substr($varmes, 0,1)==0){
		$varmes = substr($varmes, 1,1);
	}
	return $semana[$convertedia] . " | " . $vardia  . " de " . strtolower($mes[$varmes]);  
}

function slug($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	//$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}

function formata_campo($campo,$conteudo){
	switch ($campo){
		case 'text_data':
		case 'text_data_publicacao':
		case 'text_data1':
		case 'text_data2':
			$valor =  mostra_data($conteudo);
			break;
		case 'text_valor':
			$valor = number_format($conteudo, 2, ',', '.');
			break;
		default:
			$valor = $conteudo;
	}
	return $valor;
}

function gera_imagem_galeria ($img,$nov,$lar,$alt,$largura,$altura,$pb=0){	
	$img_origem = @imagecreatefromjpeg ($img) or die('JPG N�O COPIADO');
	$img_origem2 = @imagecreatetruecolor($largura,$altura);
	$crop_startX = ($largura/2)-($lar/2);
	$crop_startY = ($altura/2)-($alt/2);
	@imagecopyresampled($img_origem2, $img_origem, 0, 0, 0, 0, $largura, $altura, imagesx($img_origem),imagesy($img_origem) );
	if(!$img_origem2){
		die('N�o foi criado o JPG');
	}
	//cria a copia da imagem principal
	$img_destino = @imagecreatetruecolor($lar,$alt) ;	
	//die($img_destino);
	@imagecopyresampled($img_destino,$img_origem2,0,0,$crop_startX, $crop_startY,$lar,$alt,$lar,$alt);
	if($pb==1){
		pretobranco($img_destino);
	}
	//imprime no browser
	@imagejpeg($img_destino,"arquivos/galeria/".$nov,90);
}
function getIdYoutube($url){
 parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
 return $my_array_of_vars['v'];  
}
function cutHTML($text,$length=100,$ending='...',$cutWords=false,$considerHtml=false) {
	if($considerHtml){
		if(strlen(preg_replace('/<.*?>/', '', $text)) <= $length) { // se o texto for mais curto que $length, retornar o texto na totalidade
			return $text;
		}
		preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);// separa todas as tags html em linhas pesquis�veis
		$total_length = strlen($ending);
		$open_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			if (!empty($line_matchings[1])) { // se existir uma tag html nesta linha, consider�-la e adicion�-la ao output (sem contar com ela)
				if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) { // se for um "elemento vazio" com ou sem barra de auto-fecho xhtml (ex. <br />)
					// n�o fazer nada // se a tag for de fecho (ex. </b>)
				}else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					$pos = array_search($tag_matchings[1], $open_tags);// apagar a tag do array $open_tags
					if($pos !== false) { unset($open_tags[$pos]); }
				}else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {// se a tag � uma tag inicial (ex. <b>)
					array_unshift($open_tags, strtolower($tag_matchings[1]));// adicionar tag ao in�cio do array $open_tags
				}
				$truncate .= $line_matchings[1];// adicionar tag html ao texto $truncate
			}
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));// calcular a largura da parte do texto da linha; considerar entidades como um caracter
			if ($total_length+$content_length> $length) {
				$left = $length - $total_length;// o n�mero dos caracteres que faltam
				$entities_length = 0;
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {// pesquisar por entidades html
					foreach ($entities[0] as $entity) {// calcular a largura real de todas as entidades no alcance "legal"
						if ($entity[1]+1-$entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							break;// n�o existem mais caracteres
						}
					}
				}
				$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				break;// chegamos � largura m�xima, por isso sa�mos do loop
			} else {
				$truncate .= $line_matchings[2];
				$total_length += $content_length;
			}
			if($total_length>= $length) {// se chegarmos � largura m�xima, sa�mos do loop
				break;
			}
		}
	} else {
		if (strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = substr($text, 0, $length - strlen($ending));
		}
	}
	if (!$cutWords) {// se as palavras n�o puderem ser cortadas a meio...
		$spacepos = strrpos($truncate, ' ');// ...procurar a �ltima ocorr�ncia de um espa�o...
		if (isset($spacepos)) {
			$truncate = substr($truncate, 0, $spacepos);// ...e cortar o texto nesta posi��o
		}
	}
	$truncate .= $ending;// adicionar $ending no final do texto	
	if($considerHtml) {
		foreach ($open_tags as $tag) {// fechar todas as tags html n�o fechadas
			$truncate .= '</' . $tag . '>';
		}
	}
	return $truncate;
}

function encrypt($string) {
	global $config;
	$key = 'XQ64CQcc7g';
	$result = '';
	for ($i = 0, $k = strlen($string); $i < $k; $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key)) - 1, 1);
		$char = chr(ord($char) + ord($keychar));
		$result .= $char;
	}
	return trim(base64_encode($result));
}
function decrypt($string) {
	global $config;
	$key = 'XQ64CQcc7g';
	$result = '';
	$string = base64_decode($string);
	for ($i = 0, $k = strlen($string); $i < $k; $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key)) - 1, 1);
		$char = chr(ord($char) - ord($keychar));
		$result .= $char;
	}
	return trim($result);
}


?>