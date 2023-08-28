<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/

ini_set('memory_limit','2048M');

session_start();

$imgUrl = $_POST['imgUrl'];
$imgInitW = $_POST['imgInitW'];
$imgInitH = $_POST['imgInitH'];
$imgW = $_POST['imgW'];
$imgH = $_POST['imgH'];
$imgY1 = $_POST['imgY1'];
$imgX1 = $_POST['imgX1'];
$cropW = $_POST['cropW'];
$cropH = $_POST['cropH'];

$chave = $_POST['CHAVE'];
$proporcaoimg = $_POST['PROPORCAOIMG'];
$larguraimg = $_POST['LARGURAIMG'];
$alturaimg = $_POST['ALTURAIMG'];

$jpeg_quality = 100;
$nome_arquivo = "dest_".$chave;
$output_filename = "arquivos/imagem/dest_".$chave;
$output_filename2 = "arquivos/imagem/final_".$chave;
$output_filename3 = "arquivos/imagem/o_".$chave;

$what = getimagesize($imgUrl);
switch(strtolower($what['mime'])){
    case 'image/png':
        $img_r = imagecreatefrompng($imgUrl);
		$source_image = imagecreatefrompng($imgUrl);
		$type = '.'.$_SESSION['imagem_destaque_tipo'];
        break;
    case 'image/jpeg':
        $img_r = imagecreatefromjpeg($imgUrl);
		$source_image = imagecreatefromjpeg($imgUrl);
		$type = '.'.$_SESSION['imagem_destaque_tipo'];
        break;
    case 'image/gif':
        $img_r = imagecreatefromgif($imgUrl);
		$source_image = imagecreatefromgif($imgUrl);
		$type = '.'.$_SESSION['imagem_destaque_tipo'];
        break;
    default:
    	die('image type not supported');
}

copy($imgUrl, $output_filename3.$type);

$resizedImage = imagecreatetruecolor($imgW, $imgH);
imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);	
	
$dest_image = imagecreatetruecolor($cropW, $cropH);
imagecopyresampled($dest_image, $resizedImage, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);	

imagejpeg($dest_image, $output_filename.$type, $jpeg_quality);

if($proporcaoimg!=1){
	$imgW2 = $imgW*$proporcaoimg;
	$imgH2 = $imgH*$proporcaoimg;
	$imgX2 = ($imgX1*$imgW2)/$imgW;
	$imgY2 = ($imgY1*$imgH2)/$imgH;
	
	$resizedImage2 = imagecreatetruecolor($imgW2, $imgH2);
	imagecopyresampled($resizedImage2, $source_image, 0, 0, 0, 0, $imgW2, $imgH2, $imgInitW, $imgInitH);
	
	$dest_image2 = imagecreatetruecolor($larguraimg, $alturaimg);
	imagecopyresampled($dest_image2, $resizedImage2, 0, 0, $imgX2, $imgY2, $larguraimg,	$alturaimg, $larguraimg, $alturaimg);

	imagejpeg($dest_image2, $output_filename2.$type, $jpeg_quality);
}else{
	copy($output_filename.$type, $output_filename2.$type);
}
//copy($output_filename.$type, $output_filename3.$type);

unlink($imgUrl);

$response = array(
	"status" => 'success',
	"url" => $output_filename.$type 
);

print json_encode($response);

/*
$name = 'img_save_to_file_'.date('d').date('m').date('Y').'.txt';
$text = var_export($_REQUEST, true).$response;
$file = fopen($name, 'a');
fwrite($file, $text);
fclose($file);
*/

?>