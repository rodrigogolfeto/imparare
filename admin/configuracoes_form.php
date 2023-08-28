<?php

//---------CONFIGURANDO O TITULO DA PÁGINA--------------
	$sql_menu = "SELECT menu_titulo, menu_destacar, menu_ativar, menu_editar, menu_excluir, menu_tipo FROM tag3_menu WHERE menu_id=".addslashes($_GET['men']);
	$consulta_menu = $conexao->consulta($sql_menu); 
	$reg_menu = $conexao->busca($consulta_menu);	
	$titulo_submenu = $titulo_menu = $reg_menu[0];
	$menu_destacar = $reg_menu[1];
	$menu_ativar = $reg_menu[2];
	$menu_editar = $reg_menu[3];
	$menu_excluir = $reg_menu[4];
	$menu_tipo = $reg_menu[5];
	$_SESSION['men']=$_GET['men'];
		
	if($_GET['submen']>0){
		$sql_menu = "SELECT menu_titulo, menu_destacar, menu_ativar, menu_editar, menu_excluir, menu_tipo FROM tag3_menu WHERE menu_id=".addslashes($_GET['submen']);
		$consulta_menu = $conexao->consulta($sql_menu); 
		$reg_menu = $conexao->busca($consulta_menu);
		$titulo_submenu = $reg_menu[0];	
		$menu_destacar = $reg_menu[1];
		$menu_ativar = $reg_menu[2];
		$menu_editar = $reg_menu[3];
		$menu_excluir = $reg_menu[4];
		$submenu_tipo = $reg_menu[5];		
		$_SESSION['submen']=$_GET['submen'];		
	}
	
	if($_GET['idcat']>0){
		$sql_menu = "SELECT menu_titulo, menu_destacar, menu_ativar, menu_editar, menu_excluir, menu_tipo FROM tag3_menu WHERE menu_id=".addslashes($_GET['idcat']);
		$consulta_menu = $conexao->consulta($sql_menu); 
		$reg_menu = $conexao->busca($consulta_menu);
		$titulo_submenu = $reg_menu[0];	
		$menu_destacar = $reg_menu[1];
		$menu_ativar = $reg_menu[2];
		$menu_editar = $reg_menu[3];
		$menu_excluir = $reg_menu[4];
		//$menu_tipo = $reg_menu[5];		
		$_SESSION['submen']=$_GET['submen'];		
	}
	//----------FIM CONFIGURAÇÃO DO TÍTULO DA PÁGINA----------
	
	
	//----------CONFIGURANDO O FORMULÁRIO ------------
	if($_GET['idcat']>0){		
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
	$sql_config = "SELECT * FROM tag3_config_textos WHERE conf_menu_id=".addslashes($men)." AND conf_subm_id=".addslashes($submen);
	$consulta_config = $conexao->consulta($sql_config); 
	while($reg_config = $conexao->busca($consulta_config)){
		if($reg_config['conf_campo']=='text_titulo'){
			$conf_titulo=1;
			$conf_titulo_tit=$reg_config['conf_titulo'];
			$conf_titulo_codigo=intval($reg_config['conf_codigo']);
			$conf_titulo_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_titulo_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_resumo'){
			$conf_resumo=1;
			$conf_resumo_tit=$reg_config['conf_titulo'];
			$conf_resumo_codigo=intval($reg_config['conf_codigo']);
			$conf_resumo_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_resumo_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto'){
			$conf_texto=1;
			$conf_texto_tit=$reg_config['conf_titulo'];
			$conf_texto_codigo=intval($reg_config['conf_codigo']);
			$conf_texto_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto2'){
			$conf_texto2=1;
			$conf_texto2_tit=$reg_config['conf_titulo'];
			$conf_texto2_codigo=intval($reg_config['conf_codigo']);
			$conf_texto2_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto2_edit=$reg_config['conf_editavel'];
			$conf_texto2_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto3'){
			$conf_texto3=1;
			$conf_texto3_tit=$reg_config['conf_titulo'];
			$conf_texto3_codigo=intval($reg_config['conf_codigo']);
			$conf_texto3_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto3_edit=$reg_config['conf_editavel'];
			$conf_texto3_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto4'){
			$conf_texto4=1;
			$conf_texto4_tit=$reg_config['conf_titulo'];
			$conf_texto4_codigo=intval($reg_config['conf_codigo']);
			$conf_texto4_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto4_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto5'){
			$conf_texto5=1;
			$conf_texto5_tit=$reg_config['conf_titulo'];
			$conf_texto5_codigo=intval($reg_config['conf_codigo']);
			$conf_texto5_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto5_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto6'){
			$conf_texto6=1;
			$conf_texto6_tit=$reg_config['conf_titulo'];
			$conf_texto6_codigo=intval($reg_config['conf_codigo']);
			$conf_texto6_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto6_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto7'){
			$conf_texto7=1;
			$conf_texto7_tit=$reg_config['conf_titulo'];
			$conf_texto7_codigo=intval($reg_config['conf_codigo']);
			$conf_texto7_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto7_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto8'){
			$conf_texto8=1;
			$conf_texto8_tit=$reg_config['conf_titulo'];
			$conf_texto8_codigo=intval($reg_config['conf_codigo']);
			$conf_texto8_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto8_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto9'){
			$conf_texto9=1;
			$conf_texto9_tit=$reg_config['conf_titulo'];
			$conf_texto9_codigo=intval($reg_config['conf_codigo']);
			$conf_texto9_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto9_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_texto10'){
			$conf_texto10=1;
			$conf_texto10_tit=$reg_config['conf_titulo'];
			$conf_texto10_codigo=intval($reg_config['conf_codigo']);
			$conf_texto10_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_texto10_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_data'){
			$conf_data=1;
			$conf_data_tit=$reg_config['conf_titulo'];
			$conf_data_codigo=intval($reg_config['conf_codigo']);
			$conf_data_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_data_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_data1'){
			$conf_data=1;
			$conf_data_tit=$reg_config['conf_titulo'];
			$conf_data_codigo=intval($reg_config['conf_codigo']);
			$conf_data_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_data_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_hora'){
			$conf_hora=1;
			$conf_hora_tit=$reg_config['conf_titulo'];
			$conf_hora_codigo=intval($reg_config['conf_codigo']);
			$conf_hora_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_hora_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='selecao_simples'){
			$conf_selecaosimples=1;
			$conf_selecaosimples_tit=$reg_config['conf_titulo'];
			$conf_selecaosimples_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaosimples_codigo);
			$med = explode('.',$medidas);
			$conf_selecaosimples_codigo1 = $med[0];
			$conf_selecaosimples_codigo2 = $med[1];
			$conf_selecaosimples_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaosimples_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='selecao_simples2'){
			$conf_selecaosimples2=1;
			$conf_selecaosimples2_tit=$reg_config['conf_titulo'];
			$conf_selecaosimples2_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaosimples2_codigo);
			$med = explode('.',$medidas);
			$conf_selecaosimples2_codigo1 = $med[0];
			$conf_selecaosimples2_codigo2 = $med[1];
			$conf_selecaosimples2_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaosimples2_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='selecao_simples3'){
			$conf_selecaosimples3=1;
			$conf_selecaosimples3_tit=$reg_config['conf_titulo'];
			$conf_selecaosimples3_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaosimples3_codigo);
			$med = explode('.',$medidas);
			$conf_selecaosimples3_codigo1 = $med[0];
			$conf_selecaosimples3_codigo2 = $med[1];
			$conf_selecaosimples3_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaosimples3_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='selecao_simples4'){
			$conf_selecaosimples4=1;
			$conf_selecaosimples4_tit=$reg_config['conf_titulo'];
			$conf_selecaosimples4_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaosimples4_codigo);
			$med = explode('.',$medidas);
			$conf_selecaosimples4_codigo1 = $med[0];
			$conf_selecaosimples4_codigo2 = $med[1];
			$conf_selecaosimples4_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaosimples4_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='selecao_simples5'){
			$conf_selecaosimples5=1;
			$conf_selecaosimples5_tit=$reg_config['conf_titulo'];
			$conf_selecaosimples5_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaosimples5_codigo);
			$med = explode('.',$medidas);
			$conf_selecaosimples5_codigo1 = $med[0];
			$conf_selecaosimples5_codigo2 = $med[1];
			$conf_selecaosimples5_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaosimples5_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='selecao_multipla'){
			$conf_selecaomultipla=1;
			$conf_selecaomultipla_tit=$reg_config['conf_titulo'];
			$conf_selecaomultipla_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaomultipla_codigo);
			$med = explode('.',$medidas);
			$conf_selecaomultipla_codigo1 = $med[0];
			$conf_selecaomultipla_codigo2 = $med[1];
			$conf_selecaomultipla_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaomultipla_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_tags'){
			$conf_tags=1;
			$conf_tags_tit=$reg_config['conf_titulo'];
			$conf_tags_codigo=intval($reg_config['conf_codigo']);
			$conf_tags_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_tags_edit=intval($reg_config['conf_editavel']);
		}
		if($reg_config['conf_campo']=='text_valor'){
			$conf_valor=1;
			$conf_valor_tit=$reg_config['conf_titulo'];
			$conf_valor_codigo=intval($reg_config['conf_codigo']);
			$conf_valor_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_valor_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_link'){
			$conf_link=1;
			$conf_link_tit=$reg_config['conf_titulo'];
			$conf_link_codigo=intval($reg_config['conf_codigo']);
			$conf_link_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_link_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info1'){
			$conf_info1=1;
			$conf_info1_tit=$reg_config['conf_titulo'];
			$conf_info1_codigo=intval($reg_config['conf_codigo']);
			$conf_info1_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info1_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info2'){
			$conf_info2=1;
			$conf_info2_tit=$reg_config['conf_titulo'];
			$conf_info2_codigo=intval($reg_config['conf_codigo']);
			$conf_info2_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info2_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info3'){
			$conf_info3=1;
			$conf_info3_tit=$reg_config['conf_titulo'];
			$conf_info3_codigo=intval($reg_config['conf_codigo']);
			$conf_info3_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info3_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info4'){
			$conf_info4=1;
			$conf_info4_tit=$reg_config['conf_titulo'];
			$conf_info4_codigo=intval($reg_config['conf_codigo']);
			$conf_info4_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info4_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info5'){
			$conf_info5=1;
			$conf_info5_tit=$reg_config['conf_titulo'];
			$conf_info5_codigo=intval($reg_config['conf_codigo']);
			$conf_info5_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info5_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info6'){
			$conf_info6=1;
			$conf_info6_tit=$reg_config['conf_titulo'];
			$conf_info6_codigo=intval($reg_config['conf_codigo']);
			$conf_info6_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info6_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info7'){
			$conf_info7=1;
			$conf_info7_tit=$reg_config['conf_titulo'];
			$conf_info7_codigo=intval($reg_config['conf_codigo']);
			$conf_info7_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info7_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info8'){
			$conf_info8=1;
			$conf_info8_tit=$reg_config['conf_titulo'];
			$conf_info8_codigo=intval($reg_config['conf_codigo']);
			$conf_info8_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info8_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info9'){
			$conf_info9=1;
			$conf_info9_tit=$reg_config['conf_titulo'];
			$conf_info9_codigo=intval($reg_config['conf_codigo']);
			$conf_info9_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info9_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='text_info10'){
			$conf_info10=1;
			$conf_info10_tit=$reg_config['conf_titulo'];
			$conf_info10_codigo=intval($reg_config['conf_codigo']);
			$conf_info10_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_info10_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='arquivos'){
			$conf_arquivos=1;
			$conf_arquivos_tit=$reg_config['conf_titulo'];
			$conf_arquivos_codigo=intval($reg_config['conf_codigo']);
			$conf_arquivos_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_arquivos_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='galeria'){
			$conf_galeria=1;
			$conf_galeria_tit=$reg_config['conf_titulo'];
			$conf_galeria_codigo=intval($reg_config['conf_codigo']);
			$conf_galeria_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_galeria_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='seo'){
			$conf_seo=1;
			$conf_seo_tit=$reg_config['conf_titulo'];
			$conf_seo_codigo=intval($reg_config['conf_codigo']);
			$conf_seo_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_seo_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='status'){
			$conf_status=1;
			$conf_status_tit=$reg_config['conf_titulo'];
			$conf_status_codigo=intval($reg_config['conf_codigo']);
			$conf_status_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_status_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='data_publicacao'){
			$conf_datapublicacao=1;
			$conf_datapublicacao_tit=$reg_config['conf_titulo'];
			$conf_datapublicacao_codigo=intval($reg_config['conf_codigo']);
			$conf_datapublicacao_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_datapublicacao_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='selecao_lateral'){
			$conf_selecaolateral=1;
			$conf_selecaolateral_tit=$reg_config['conf_titulo'];
			$conf_selecaolateral_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaolateral_codigo);
			$med = explode('.',$medidas);
			$conf_selecaolateral_codigo1 = $med[0];
			$conf_selecaolateral_codigo2 = $med[1];
			$conf_selecaolateral_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaolateral_edit=intval($reg_config['conf_editavel']);
		}

		if($reg_config['conf_campo']=='selecao_lateral2'){
			$conf_selecaolateral2=1;
			$conf_selecaolateral2_tit=$reg_config['conf_titulo'];
			$conf_selecaolateral2_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaolateral2_codigo);
			$med = explode('.',$medidas);
			$conf_selecaolateral2_codigo1 = $med[0];
			$conf_selecaolateral2_codigo2 = $med[1];
			$conf_selecaolateral2_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaolateral2_edit=intval($reg_config['conf_editavel']);
		}

		if($reg_config['conf_campo']=='selecao_lateral3'){
			$conf_selecaolateral3=1;
			$conf_selecaolateral3_tit=$reg_config['conf_titulo'];
			$conf_selecaolateral3_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaolateral3_codigo);
			$med = explode('.',$medidas);
			$conf_selecaolateral3_codigo1 = $med[0];
			$conf_selecaolateral3_codigo2 = $med[1];
			$conf_selecaolateral3_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaolateral3_edit=intval($reg_config['conf_editavel']);
		}

		if($reg_config['conf_campo']=='selecao_lateral4'){
			$conf_selecaolateral4=1;
			$conf_selecaolateral4_tit=$reg_config['conf_titulo'];
			$conf_selecaolateral4_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaolateral4_codigo);
			$med = explode('.',$medidas);
			$conf_selecaolateral4_codigo1 = $med[0];
			$conf_selecaolateral4_codigo2 = $med[1];
			$conf_selecaolateral4_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaolateral4_edit=intval($reg_config['conf_editavel']);
		}

		if($reg_config['conf_campo']=='selecao_lateral5'){
			$conf_selecaolateral5=1;
			$conf_selecaolateral5_tit=$reg_config['conf_titulo'];
			$conf_selecaolateral5_codigo=$reg_config['conf_codigo'];
			$medidas = strval($conf_selecaolateral5_codigo);
			$med = explode('.',$medidas);
			$conf_selecaolateral5_codigo1 = $med[0];
			$conf_selecaolateral5_codigo2 = $med[1];
			$conf_selecaolateral5_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_selecaolateral5_edit=intval($reg_config['conf_editavel']);
		}
		
		if($reg_config['conf_campo']=='imagem_destaque'){
			$conf_imagemdestaque=1;
			$conf_imagemdestaque_tit=$reg_config['conf_titulo'];
			$conf_imagemdestaque_codigo=$reg_config['conf_codigo'];
			$conf_imagemdestaque_obrigatorio=intval($reg_config['conf_obrigatoriedade']);
			$conf_imagemdestaque_edit=intval($reg_config['conf_editavel']);
			$medidas = strval($conf_imagemdestaque_codigo);
			$med = explode('.',$medidas);
			$larImgDest = $med[0];
			$altImgDest = $med[1];
			if($larImgDest<360){
				$larguraCrop = $larImgDest;
				$alturaCrop = $altImgDest;
				$proporcaoImagens = 1;
			}else{
				$larguraCrop = 360;
				$alturaCrop = (360*$altImgDest)/$larImgDest;
				$proporcaoImagens = $larImgDest/360;
			}
		}
	
	}	
//----------FIM CONFIGURAÇÃO DO FORMULARIO -----------
?>