<?php 
if(empty($_FILES['file']))
{
	exit();	
}
$errorImgFile = "images/img_upload_error.jpg";
$destinationFilePath = 'arquivos/imagem/'.$_FILES['file']['name'];
if(!move_uploaded_file($_FILES['file']['tmp_name'], $destinationFilePath)){
	echo $errorImgFile;
}
else{
	echo "http://www.uniderpfm.com.br/admin/".$destinationFilePath;
}

?>