<?php
include('cabeca.php');
include('configuracoes_form.php');
if($_POST['chave']!=''){
	//print_r($_POST);
	if($_GET['idcat']!=''){
		$idcate = addslashes($_GET['idcat']);		
		$medidas = strval($idcate);
		$med = explode('.',$medidas);
		$men = $med[0];
		$submen = intval($med[1]);
		//$men = $_GET['idcat'];
		//$submen = 0;
	}else{
		$men = $_GET['men'];
		$submen = $_GET['submen'];
	}
	if($conf_datapublicacao==1){
		$campoData = array_reverse(explode('/',$_POST['campoDataPublicacao']));
		$campoData = implode('-',$campoData);
		$campoData .= " ".$_POST['campoHoraPublicacao'].":00";
	}
	if($_POST['campoId']==''){
		$sql = "INSERT INTO ";
	}else{
		$sql = "UPDATE ";
	}
	$sql .= "tag3_textos SET ";
	$sql .= "text_usu_id='".$_SESSION["usuario"]->getId()."', ";
	$sql .= "text_data=now(), ";

	if($_POST['campoId']==''){
		$sql .= "text_menu_id='".addslashes($men)."', ";
		$sql .= "text_subm_id='".addslashes($submen)."', ";
	}
	
	if($conf_titulo_edit==1){
		$sql .= "text_titulo='".addslashes($_POST['campoTitulo'])."', ";
	}
	if($conf_resumo_edit==1){
		$sql .= "text_resumo='".addslashes($_POST['campoResumo'])."', ";
	}
	if($conf_texto_edit==1){
		$sql .= "text_texto='".addslashes($_POST['campoTexto'])."', ";
	}
	if($conf_texto2_edit==1){
		$sql .= "text_texto2='".addslashes($_POST['campoTexto2'])."', ";
	}
	if($conf_texto3_edit==1){
		$sql .= "text_texto3='".addslashes($_POST['campoTexto3'])."', ";
	}
	if($conf_texto4_edit==1){
		$sql .= "text_texto4='".addslashes($_POST['campoTexto4'])."', ";
	}
	if($conf_texto5_edit==1){
		$sql .= "text_texto5='".addslashes($_POST['campoTexto5'])."', ";
	}
	if($conf_texto6_edit==1){
		$sql .= "text_texto6='".addslashes($_POST['campoTexto6'])."', ";
	}
	if($conf_texto7_edit==1){
		$sql .= "text_texto7='".addslashes($_POST['campoTexto7'])."', ";
	}
	if($conf_texto8_edit==1){
		$sql .= "text_texto8='".addslashes($_POST['campoTexto8'])."', ";
	}
	if($conf_texto9_edit==1){
		$sql .= "text_texto9='".addslashes($_POST['campoTexto9'])."', ";
	}
	if($conf_texto10_edit==1){
		$sql .= "text_texto10='".addslashes($_POST['campoTexto10'])."', ";
	}
	if($conf_info1_edit==1){
		$sql .= "text_info1='".addslashes($_POST['campoInfo1'])."', ";
	}
	if($conf_info2_edit==1){
		$sql .= "text_info2='".addslashes($_POST['campoInfo2'])."', ";
	}
	if($conf_info3_edit==1){
		$sql .= "text_info3='".addslashes($_POST['campoInfo3'])."', ";
	}
	if($conf_info4_edit==1){
		$sql .= "text_info4='".addslashes($_POST['campoInfo4'])."', ";
	}
	if($conf_info5_edit==1){
		$sql .= "text_info5='".addslashes($_POST['campoInfo5'])."', ";
	}
	if($conf_info6_edit==1){
		$sql .= "text_info6='".addslashes($_POST['campoInfo6'])."', ";
	}
	if($conf_info7_edit==1){
		$sql .= "text_info7='".addslashes($_POST['campoInfo7'])."', ";
	}
	if($conf_info8_edit==1){
		$sql .= "text_info8='".addslashes($_POST['campoInfo8'])."', ";
	}
	if($conf_info9_edit==1){
		$sql .= "text_info9='".addslashes($_POST['campoInfo9'])."', ";
	}
	if($conf_info10_edit==1){
		$sql .= "text_info10='".addslashes($_POST['campoInfo10'])."', ";
	}
	if($conf_data_edit==1){
		$campoData1 = array_reverse(explode('/',$_POST['campoData1']));
		$campoData1 = implode('-',$campoData1);
		$sql .= "text_data1='".$campoData1."', ";				
		if($conf_data_codigo==1){
			$campoData2 = array_reverse(explode('/',$_POST['campoData2']));
			$campoData2 = implode('-',$campoData2);
			$sql .= "text_data2='".$campoData2."', ";
		}else{
			$sql .= "text_data2='1000-01-01', ";
		}
	}else{
		$sql .= "text_data1='1000-01-01', ";
		$sql .= "text_data2='1000-01-01', ";
	}
	if($conf_hora_edit==1){
		$sql .= "text_hora1='".addslashes($_POST['campoHora1']).":00', ";
		if($conf_hora_codigo==1){
			$sql .= "text_hora2='".addslashes($_POST['campoHora2']).":00', ";
		}else{
			$sql .= "text_hora2='00:00:00', ";
		}
	}else{
		$sql .= "text_hora1='00:00:00', ";
		$sql .= "text_hora2='00:00:00', ";
	}
	if($conf_valor_edit==1){
		$sql .= "text_valor='".addslashes(trim(str_replace(",",".",str_replace(".","",$_POST['campoValor']))))."', ";
	}
	if($conf_tags_edit==1){
		$sql .= "text_tags='".addslashes(implode(",",$_POST['campoTags']))."', ";
	}
	if($conf_link_edit==1){
		$sql .= "text_link='".addslashes($_POST['campoLink'])."', ";
	}
	if($conf_datapublicacao_edit==1){
		$sql .= "text_data_publicacao='".$campoData."', ";
	}else{
		$sql .= "text_data_publicacao=now(), ";
	}
	if($conf_status_edit==1){
		$sql .= "text_status='".addslashes($_POST['campoStatus'])."'";
	}else{
		$sql .= "text_status='1'";
	}
	if($_POST['campoId']!=''){
		$sql .= " WHERE text_id='".addslashes($_POST['campoId'])."'";
	}
	//die($sql);
	$consulta = $conexao->consulta($sql);
	$id_novo = $consulta;	
	
	if($id_novo){

		if($_POST['campoId']!=""){
			$id_novo = $_POST['campoId'];
		}
		
		if($conf_arquivos_edit==1){
			$sql_arquivos = "UPDATE tag3_arquivos SET arqu_text_id=".$id_novo." WHERE arqu_chave='".$_POST['chave']."'";
			$consulta_arquivos = $conexao->consulta($sql_arquivos);
		}
		if($conf_galeria_edit==1){
			$sql_galeria = "UPDATE tag3_galeria SET foto_text_id=".$id_novo." WHERE foto_chave='".$_POST['chave']."'";
			$consulta_galeria = $conexao->consulta($sql_galeria);
		}
		if($conf_seo_edit==1){ 
			$sql_seo = "UPDATE tag3_seo SET seo_text_id=".$id_novo.", ";
			$sql_seo .= " seo_google_desc='".addslashes($_POST['campoGoogleDesc'])."', ";
			$sql_seo .= " seo_google_tags='".addslashes($_POST['campoGoogleTags'])."', ";
			$sql_seo .= " seo_facebook_titulo='".addslashes($_POST['campoFacebookTitulo'])."', ";
			$sql_seo .= " seo_facebook_desc='".addslashes($_POST['campoFacebookDesc'])."', ";
			$sql_seo .= " seo_twitter_titulo='".addslashes($_POST['campoTwitterTitulo'])."', ";
			$sql_seo .= " seo_twitter_desc='".addslashes($_POST['campoTwitterDesc'])."', ";
			$sql_seo .= " seo_twitter_autor='".addslashes($_POST['campoTwitterAutor'])."' ";
			$sql_seo .= "WHERE seo_chave='".$_POST['chave']."'";
			$consulta_seo = $conexao->consulta($sql_seo);
		}

		// LIMPA RELACIONAMENTOS
		$sql = "DELETE FROM tag3_relacionamentos WHERE rela_filho=".$id_novo."";
		$consulta = $conexao->consulta($sql);	

		if($conf_selecaosimples==1){
			$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$_POST['campoSelectSimples'];
			$consulta = $conexao->consulta($sql);
		}

		if($conf_selecaosimples2==1){
			$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$_POST['campoSelectSimples2'];
			$consulta = $conexao->consulta($sql);
		}

		if($conf_selecaosimples3==1){
			$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$_POST['campoSelectSimples3'];
			$consulta = $conexao->consulta($sql);
		}

		if($conf_selecaosimples4==1){
			$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$_POST['campoSelectSimples4'];
			$consulta = $conexao->consulta($sql);
		}

		if($conf_selecaosimples5==1){
			$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$_POST['campoSelectSimples5'];
			$consulta = $conexao->consulta($sql);
		}
		
		if($conf_selecaomultipla==1){
			$vetor = $_POST['campoSelectMultiplo'];
			for($i=0;$i<count($vetor);$i++){
				$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$vetor[$i];
				$consulta = $conexao->consulta($sql);
			}
		}

		if($conf_selecaolateral==1){
			$vetor = $_POST['campoSelecaoLateral'];
			//for($i=0;$i<count($vetor);$i++){
				$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$vetor;
				$consulta = $conexao->consulta($sql);
			//}
		}

		if($conf_selecaolateral2==1){
			$vetor = $_POST['campoSelecaoLateral2'];
			//for($i=0;$i<count($vetor);$i++){
				$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$vetor;
				$consulta = $conexao->consulta($sql);
			//}
		}

		if($conf_selecaolateral3==1){
			$vetor = $_POST['campoSelecaoLateral3'];
			//for($i=0;$i<count($vetor);$i++){
				$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$vetor;
				$consulta = $conexao->consulta($sql);
			//}
		}

		if($conf_selecaolateral4==1){
			$vetor = $_POST['campoSelecaoLateral4'];
			//for($i=0;$i<count($vetor);$i++){
				$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$vetor;
				$consulta = $conexao->consulta($sql);
			//}
		}

		if($conf_selecaolateral5==1){
			$vetor = $_POST['campoSelecaoLateral5'];
			//for($i=0;$i<count($vetor);$i++){
				$sql = "INSERT INTO tag3_relacionamentos SET rela_filho=".$id_novo.", rela_pai=".$vetor;
				$consulta = $conexao->consulta($sql);
			//}
		}
		
		if($conf_imagemdestaque==1){
			$sql_imagens = "UPDATE tag3_imagens SET imag_text_id=".$id_novo." WHERE imag_chave='".$_POST['chave']."'";
			$consulta_imagens = $conexao->consulta($sql_imagens);
		}

		$slv = '1';

	}else{
		$slv = '0';
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processando...</title>
</head>

<body>
&nbsp;Processando...
<?php if($_POST['redirect']=='lista'){ ?>
<script>window.open('lista.php?id=<?php echo $_GET['id'];?>&men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>&idtex=<?php echo $_GET['idtex'];?>&idcat=<?php echo $_GET['idcat'];?>&slv=<?php echo $slv; ?>', '_self');</script>
<?php }else{ ?>
<script>window.open('form.php?men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>&slv=<?php echo $slv; ?>', '_self');</script>
<?php }; ?>
</body>
</html>