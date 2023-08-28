<?php function pretobranco($img_destino){
	$rateR = .229;
	$rateG = .587;
	$rateB = .114;
	$whiteness = 3;
	$numColors = 0;
	$colorsToWork  = 256;
	imagetruecolortopalette($img_destino, true, $colorsToWork);
	$numColors = imagecolorstotal($img_destino);
	for ($x = 0; $x < $numColors; $x++)
        {
            $src_colors  = imagecolorsforindex($img_destino,$x);
            $new_color    = min(255,abs($src_colors["red"] * $rateR + $src_colors["green"] * $rateG + $src_colors["blue"] * $rateB) + $whiteness);
            imagecolorset($img_destino,$x,$new_color,$new_color,$new_color);
        }
}
function gera_thumb ($img,$lar,$alt,$largura,$altura,$pb=0){	
	$img_origem = @imagecreatefromjpeg ($img) or die('JPG NÃO COPIADO');
	$img_origem2 = @imagecreatetruecolor($largura,$altura) ;
	//die('asdass'.imagesx($img_origem));
	@imagecopyresampled($img_origem2, $img_origem, 0, 0, 0, 0, $largura, $altura, imagesx($img_origem),imagesy($img_origem) );
	//@imagejpeg($img_origem2,"",70);
	//die();
	if(!$img_origem2) //or !$img_origem2)
	{
		die('Não foi criado o JPG');
	}
	//cria a copia da imagem principal
	$img_destino = @imagecreatetruecolor($lar,$alt) ;
	
	//die($img_destino);
	@imagecopyresampled($img_destino,$img_origem2,0,0,0,0,$lar,$alt,$lar,$alt);
	if($pb==1){
		pretobranco($img_destino);
	}
	//imprime no browser
	@imagejpeg($img_destino,"",90);
}


$x0 = $_GET['largura'];
$y0 = $_GET['altura'];
$largura = $_GET['largura'];
$altura = $_GET['altura'];
$img = $_GET['img'];
$pb = $_GET['pb'];

list($x, $y, $type, $attr) = getimagesize($img);
if(!$x0){
	$x0 = ($x*$y0)/$y;
	$largura = $x0;
}else if(!$y0){
	$y0 = ($y*$x0)/$x;
	$altura = $y0;
}

$checaaltura = ($x0/$x)*$y;
$checalargura = ($y0/$y)*$x;

if($checaaltura > $y0){
	//primeiro a largura
	$nova_largura = $x0;
	$nova_altura = $checaaltura;
	
}else{
	//primeiro a altura
	$nova_largura = $checalargura;
	$nova_altura = $y0;
}
//die($nova_largura.'^^^^'.$nova_altura);
gera_thumb($img,$largura,$altura,$nova_largura,$nova_altura,$pb);
?>