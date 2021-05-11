<?php

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
    $yr=strval(substr($dt,0,4)); 
    $mo=strval(substr($dt,5,2)); 
    $da=strval(substr($dt,8,2)); 
    $hr=strval(substr($dt,11,2)); 
    $mi=strval(substr($dt,14,2)); 
    $se=strval(substr($dt,17,2)); 
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
	
	$semana = array("Sun" => "Domingo", "Mon" => "Segunda-feira", "Tue" => "Terηa-feira", "Wed" => "Quarta-feira", "Thu" => "Quinta-feira", "Fri" => "Sexta-feira", "Sat" => "Sαbado"); /* Dias da Semana. */ 
		  
	$mes = array(1=>"JANEIRO", "FEVEREIRO", "MARCO", "ABRIL", "MAIO", "JUNHO", "JULHO", "AGOSTO", "SETEMBRO", "OUTUBRO", "NOVEMBRO", "DEZEMBRO");  
	if(substr($varmes, 0,1)==0){
		$varmes = substr($varmes, 1,1);
	}
	return $semana[$convertedia] . " | " . $vardia  . " de " . strtolower($mes[$varmes]);  
}

function cleanURI($input)
{
        return ereg_replace(
                '[^a-z0-9-]',
                '',
                ereg_replace(
                        ' +',
                        '-',
                        strtr(
                                strtolower(html_entity_decode($input)),
                                'ΰαγβικνσυτϊόηρ',
                                'aaaaeeiooouucn'
                        )
                )
        );
}

function formata_campo($campo,$conteudo){
	switch ($campo){
		case 'text_data':
		case 'text_data_publicacao':
		case 'text_datahora1':
		case 'text_datahora2':
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

function getIdYoutube($url){
 parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
 return $my_array_of_vars['v'];  
}
?>