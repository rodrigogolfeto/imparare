<?php
//Local do cliente
date_default_timezone_set('America/Sao_Paulo');
//Nome do site do cliente
$__nomeCliente = "Novilho Precoce";
$__urlCliente = "novilhoms.com.br";
if ($_SERVER['HTTP_HOST'] == "abarache") {
	$caminhoCompleto = 'http://abarache/novilhoms/admin/';
	$caminhoSite = 'http://abarache/aguasguariroba/';
} else {
	$caminhoCompleto = $_SERVER['HTTP_HOST'].'/admin/';
	$caminhoSite = $_SERVER['HTTP_HOST'];
}
?>