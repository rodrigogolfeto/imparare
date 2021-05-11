<?php
	$noticiasM = 'marcado';
	include('cabeca.php');
	include('configuracoes_form.php');	
	$_SESSION['imagem_destaque_nome'] = "";
	$_SESSION['imagem_destaque_tipo'] = "";
	$_SESSION['imagem_anterior_banco'] = "";
	
	if($_GET['id']!=''){
		$id_texto = $_GET['id'];
		$redirect = 'lista';
	}else{
		if($submenu_tipo=='form'){
			$consulta = $conexao->consulta("SELECT text_id FROM tag3_textos WHERE text_subm_id=".addslashes($_GET['submen'])); 
			$reg = $conexao->busca($consulta);
			$id_texto = $reg[0];
			$redirect = 'form';
		}else if($menu_tipo=='form'){
			$consulta = $conexao->consulta("SELECT text_id FROM tag3_textos WHERE text_menu_id=".addslashes($_GET['men'])); 
			$reg = $conexao->busca($consulta);
			$id_texto = $reg[0];
			$redirect = 'form';
		}else{
			$id_texto = '';
			$redirect = 'lista';
		}
	}
	
	if($id_texto!=''){		
		$consulta = $conexao->consulta("SELECT * FROM tag3_textos WHERE text_id=".addslashes($id_texto)); 
		$reg = $conexao->busca($consulta);
		$data = mostra_data($reg['text_data_publicacao']);
		$hora = mostra_hora($reg['text_data_publicacao']);
		
		//chave temporária para atribuir arquivos a uma ID que ainda não foi criada no caso de novo registro (neste caso resgata do banco de dados)
		$consulta_arq = $conexao->consulta("SELECT * FROM tag3_arquivos WHERE arqu_text_id=".addslashes($id_texto)); 
		$reg_arq = $conexao->busca($consulta_arq);		
		if($reg_arq['arqu_chave']!=""){
			$chave = $reg_arq['arqu_chave'];
		}else{
			$consulta_arq = $conexao->consulta("SELECT * FROM tag3_galeria WHERE foto_text_id=".addslashes($id_texto)); 
			$reg_arq = $conexao->busca($consulta_arq);
			if($reg_arq['foto_chave']!=""){
				$chave = $reg_arq['foto_chave'];
			}else{
				$consulta_img = $conexao->consulta("SELECT * FROM tag3_imagens WHERE imag_text_id=".addslashes($id_texto)); 
				$reg_img = $conexao->busca($consulta_img);
				if($reg_img['imag_chave']!=""){
					$chave = $reg_img['imag_chave'];
				}else{
					$chave = 'key_'.microtime();
				}
			}
		}
				
		$consulta_imagem = $conexao->consulta("SELECT * FROM tag3_imagens WHERE imag_text_id=".addslashes($id_texto)); 
		$reg_imagem = $conexao->busca($consulta_imagem);

		
	}else{
		//chave temporária para atribuir arquivos a uma ID que ainda não foi criada no caso de novo registro
        $substituir = array('(',')','.',',','-','|','+','*','/','\\','"',"'",' ');
		$chave = str_replace($substituir,'','key_'.microtime());
		$data = date('d/m/Y');
		$hora = date('H:i');
	}
?>        
        
        <script src="Scripts/swfobject_modified.js"></script>
        <script>		
			$(window).bind('scroll',function(e){var distancia = $('.div-form').offset();if( $(document).scrollTop() >= distancia.top ){$('.div-lateral').addClass('fixo');$('.scrollbar').perfectScrollbar('update')}else if($(document).scrollTop() <= distancia.top){$('.div-lateral').removeClass('fixo');$('.scrollbar').perfectScrollbar('update')}});
		</script>        
        
        <!-- Modal Imagem Destaque -->
        <script>
			$(function(){
				var croppicHeaderOptions = {
						uploadUrl:'img_save_to_file.php',
						uploadData:{
							"ID":<?php if($id_texto!=''){ echo $id_texto; }else{ echo 0; }; ?>,
							"CHAVE":"<?php echo $chave;?>"
						},
						cropData:{
							"ID":<?php if($id_texto!=''){ echo $id_texto; }else{ echo 0; }; ?>,
							"CHAVE":"<?php echo $chave;?>",
							"LARGURAIMG":<?php echo $larImgDest;?>,
							"ALTURAIMG":<?php echo $altImgDest;?>,
							"PROPORCAOIMG":<?php echo $proporcaoImagens;?>
						},
						cropUrl:'img_crop_to_file.php',
						customUploadButtonId:'cropContainerHeaderButton',
						modal:false,
						loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>'
						/*
						onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
						onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
						onImgDrag: function(){ console.log('onImgDrag') },
						onImgZoom: function(){ console.log('onImgZoom') },
						onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
						onAfterImgCrop:function(){ console.log('onAfterImgCrop') }
						*/
				}	
				var croppic = new Croppic('croppic', croppicHeaderOptions);
			});
		</script>
        <div class="modal fade" id="destaqueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">Configurar Imagem Destaque</h4>
              </div><!-- modal-header -->
              <div class="modal-body">
                
                <div class="div-configurar-imagem hor">
                	<div class="div-cont-foto">
                    	<div class="content">
                        	<div class="row">
                                <div class="div-foto" id="croppic" style="width:<?php echo $larguraCrop;?>px;height:<?php echo $alturaCrop;?>px;"></div><!-- div-foto -->
                                <a href="javascript:;" class="sel-foto" id="cropContainerHeaderButton">Selecionar nova imagem</a>
                            </div><!-- row -->
                        </div><!-- content -->
                    </div><!-- div-cont-foto -->
                    <div class="div-form-modal form-destaque">
                    	<form id="" name="" method="" action="">
                        	<label>Legenda</label>
                            <input type="text" id="campoLegendaImg" name="campoLegendaImg" value="<?php echo $reg_imagem['imag_legenda'];?>" />
                            <label>Descrição</label>
                            <textarea id="campoDescricaoImg" name="campoDescricaoImg"><?php echo $reg_imagem['imag_descricao'];?></textarea>
                            <input type="hidden" id="campoIdTexto" name="campoIdTexto" value="<?php echo $id_texto;?>" />
                            <input type="hidden" id="campoChave" name="campoChave" value="<?php echo $chave;?>" />
                            <input type="hidden" id="campoIdImagem" name="campoIdImagem" value="<?php echo $reg_imagem['imag_id'];?>" />
                        </form>
                    </div><!-- div-form-modal -->
                </div><!-- div-imagem-destaque -->
              
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="salvarAlteracaoImagem(document.getElementById('campoLegendaImg').value,document.getElementById('campoDescricaoImg').value,document.getElementById('campoIdTexto').value,document.getElementById('campoChave').value,document.getElementById('campoIdImagem').value)">Aplicar Alteração</button>
              </div><!-- modal-footer -->
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
        <!-- Modal Imagem Destaque -->
        
        <!-- Modal editar arquivo -->
        <div class="modal fade" id="arquivoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">Editar arquivo</h4>
              </div><!-- modal-header -->
              <div class="modal-body">
                                
              	<div class="div-form-modal">
                    <form id="" name="" method="" action="">
                        <label>Nome do arquivo</label>
                        <input type="text" id="campoEditaArquivo" name="campoEditaArquivo" value="" />
                        <input type="hidden" id="campoIdArquivo" name="campoIdArquivo" value="" />
                    </form>
                </div><!-- div-form-modal -->
                
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="salvarAlteracaoArquivo(document.getElementById('campoIdArquivo').value,document.getElementById('campoEditaArquivo').value)">Aplicar Alteração</button>
              </div><!-- modal-footer -->
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
        <!-- Modal editar arquivo -->
        
        <!-- Modal editar foto -->
        <div class="modal fade" id="galeriaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">Editar arquivo</h4>
              </div><!-- modal-header -->
              <div class="modal-body">
                                
              	<div class="div-form-modal">
                    <form id="" name="" method="" action="">
                        <label>Legenda da Foto</label>
                        <input type="text" id="campoLegendaFoto" name="campoLegendaFoto" />
                        <input type="hidden" id="campoIdFoto" name="campoIdFoto" value="" />
                    </form>
                </div><!-- div-form-modal -->
                
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="salvarAlteracaoFoto(document.getElementById('campoIdFoto').value,document.getElementById('campoLegendaFoto').value)">Aplicar Alteração</button>
              </div><!-- modal-footer -->
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
        <!-- Modal editar foto -->
        

        
        <div id="conteudo">
        	
            <?php include('topo.php'); ?>
            
            <div class="div-conteudo">
            	
                <h1><i>&nbsp;</i><?php echo $titulo_menu;?></h1>
                
                <div class="div-abas">
                	<div class="div-cont-abas" id="cont-abas">
                        <ul class="ul-abas ulabas">
                            <li><a href="lista.php?men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>" <?php if($_GET['idtex']==''){?>class="marcado"<?php }; ?> data-id="bx1"> <?php if($_GET['idtex']!=''){?><< voltar<?php }else{ ?><?php echo $titulo_submenu;?><?php }; ?></a></li>
                        </ul><!-- ul-abas -->
                        
                    </div><!-- div-cont-abas -->
                </div><!-- div-abas -->
                
                <div class="div-box-aba marcado" id="bx1">                	
                    					                    
                    <div class="div-main">                    	
                        <div class="div-callback">
                        	<?php if(is_numeric($_GET['slv']) && $_GET['slv']==1){ ?>
                                <script>fecharMsg();</script>
                        	   <div class="div-mensagem sucesso">Texto salvo com sucesso!<a href="javascirpt:;" class="bt bt-fechar">Fechar</a></div><!-- div-mensagem -->
                            <?php }elseif(is_numeric($_GET['slv']) && $_GET['slv']==0){ ?>
                                <script>fecharMsg();</script>
                                <div class="div-mensagem erro">Erro ao publicar, tente novamente.<a href="javascript:;" class="bt bt-fechar">Fechar</a></div><!-- div-mensagem -->
                            <?php }; ?>
                            <?php /*<div class="div-mensagem erro">Exemplo de mensagem de erro<a href="javascirpt:;" class="bt bt-fechar">Fechar</a></div><!-- div-mensagem -->
                            <div class="div-mensagem alerta">Exemplo de mensagem de alerta<a href="javascirpt:;" class="bt bt-fechar">Fechar</a></div><!-- div-mensagem -->
							*/ ?>
                        </div><!-- div-callback -->

                        <div class="div-form">
                        	<form id="formTexto" name="formTexto" method="post" action="processando.php?id=<?php echo $_GET['id'];?>&men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>&idtex=<?php echo $_GET['idtex'];?>&idcat=<?php echo $_GET['idcat'];?>">
                            	<input type="hidden" id="chave" name="chave" value="<?php echo $chave;?>"  />
                                <input type="hidden" id="campoId" name="campoId" value="<?php echo $id_texto;?>"  />
                                <input type="hidden" id="redirect" name="redirect" value="<?php echo $redirect;?>"  />
								<?php if($conf_titulo==1){ ?>
                                <div class="div-campo">
                                	<label class="bl"><?php echo $conf_titulo_tit;?> <?php if($conf_titulo_codigo>0){ ?><span id="contTit">0/<?php echo $conf_titulo_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_titulo_edit==1){ ?>
                                    <input type="text"  id="campoTitulo" name="campoTitulo" data-rel="<?php echo $conf_titulo_tit;?>" data-id="<?php echo $conf_titulo_obrigatorio;?>" <?php if($conf_titulo_codigo>0){ ?>onKeyUp="return  Contador('campoTitulo',<?php echo $conf_titulo_codigo;?>, 'contTit');"<?php }; ?> value="<?php echo $reg['text_titulo'];?>" />
                                	<?php }else{ ?>
                                    	<div class="mostra">
                                        	<?php echo $reg['text_titulo'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
								<?php }; ?>                                
                               
                               <?php if($conf_resumo==1){ ?>
                                <div class="div-campo">
                                	<label class="bl"><?php echo $conf_resumo_tit;?> <?php if($conf_resumo_codigo>0){ ?><span id="contRes">0/<?php echo $conf_resumo_codigo;?></span><?php }; ?></label>
                                    <textarea  id="campoResumo" name="campoResumo" data-rel="<?php echo $conf_resumo_tit;?>" data-id="<?php echo $conf_resumo_obrigatorio;?>" <?php if($conf_resumo_codigo>0){ ?>onKeyUp="return  Contador('campoResumo',<?php echo $conf_resumo_codigo;?>, 'contRes');"<?php }; ?> ><?php echo $reg['text_resumo'];?></textarea> 
                                </div><!-- div-campo -->
                                <?php }; ?>
                                
                                <?php if($conf_texto==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto_tit;?> <?php if($conf_texto_codigo>1){ ?><span id="contTexto">0/<?php echo $conf_texto_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto_edit==1){ ?>
                                        <textarea  id="campoTexto" name="campoTexto" data-rel="<?php echo $conf_texto_tit;?>" data-id="<?php echo $conf_texto_obrigatorio;?>" <?php if($conf_texto_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto_codigo>1){ ?>onKeyUp="return  Contador('campoTexto',<?php echo $conf_texto_codigo;?>, 'contTexto');"<?php }; ?>><?php echo $reg['text_texto'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto2==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto2_tit;?> <?php if($conf_texto2_codigo>1){ ?><span id="contTexto2">0/<?php echo $conf_texto2_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto2_edit==1){ ?>
                                        <textarea  id="campoTexto2" name="campoTexto2" data-rel="<?php echo $conf_texto2_tit;?>" data-id="<?php echo $conf_texto2_obrigatorio;?>" <?php if($conf_texto2_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto2_codigo>1){ ?>onKeyUp="return  Contador('campoTexto2',<?php echo $conf_texto2_codigo;?>, 'contTexto2');"<?php }; ?>><?php echo $reg['text_texto2'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto2'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto3==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto3_tit;?> <?php if($conf_texto3_codigo>1){ ?><span id="contTexto3">0/<?php echo $conf_texto3_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto3_edit==1){ ?>
                                        <textarea  id="campoTexto3" name="campoTexto3" data-rel="<?php echo $conf_texto3_tit;?>" data-id="<?php echo $conf_texto3_obrigatorio;?>" <?php if($conf_texto3_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto3_codigo>1){ ?>onKeyUp="return  Contador('campoTexto3',<?php echo $conf_texto3_codigo;?>, 'contTexto3');"<?php }; ?>><?php echo $reg['text_texto3'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto3'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto4==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto4_tit;?> <?php if($conf_texto4_codigo>1){ ?><span id="contTexto4">0/<?php echo $conf_texto4_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto4_edit==1){ ?>
                                        <textarea  id="campoTexto4" name="campoTexto4" data-rel="<?php echo $conf_texto4_tit;?>" data-id="<?php echo $conf_texto4_obrigatorio;?>" <?php if($conf_texto4_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto4_codigo>1){ ?>onKeyUp="return  Contador('campoTexto4',<?php echo $conf_texto4_codigo;?>, 'contTexto4');"<?php }; ?>><?php echo $reg['text_texto4'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto4'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto5==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto5_tit;?> <?php if($conf_texto5_codigo>1){ ?><span id="contTexto5">0/<?php echo $conf_texto5_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto5_edit==1){ ?>
                                        <textarea  id="campoTexto5" name="campoTexto5" data-rel="<?php echo $conf_texto5_tit;?>" data-id="<?php echo $conf_texto5_obrigatorio;?>" <?php if($conf_texto5_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto5_codigo>1){ ?>onKeyUp="return  Contador('campoTexto5',<?php echo $conf_texto5_codigo;?>, 'contTexto5');"<?php }; ?>><?php echo $reg['text_texto5'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto5'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto6==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto6_tit;?> <?php if($conf_texto6_codigo>1){ ?><span id="contTexto6">0/<?php echo $conf_texto6_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto6_edit==1){ ?>
                                        <textarea  id="campoTexto6" name="campoTexto6" data-rel="<?php echo $conf_texto6_tit;?>" data-id="<?php echo $conf_texto6_obrigatorio;?>" <?php if($conf_texto6_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto6_codigo>1){ ?>onKeyUp="return  Contador('campoTexto6',<?php echo $conf_texto6_codigo;?>, 'contTexto6');"<?php }; ?>><?php echo $reg['text_texto6'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto6'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto7==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto7_tit;?> <?php if($conf_texto7_codigo>1){ ?><span id="contTexto7">0/<?php echo $conf_texto7_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto7_edit==1){ ?>
                                        <textarea  id="campoTexto7" name="campoTexto7" data-rel="<?php echo $conf_texto7_tit;?>" data-id="<?php echo $conf_texto7_obrigatorio;?>" <?php if($conf_texto7_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto7_codigo>1){ ?>onKeyUp="return  Contador('campoTexto7',<?php echo $conf_texto7_codigo;?>, 'contTexto7');"<?php }; ?>><?php echo $reg['text_texto7'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto7'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto8==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto8_tit;?> <?php if($conf_texto8_codigo>1){ ?><span id="contTexto8">0/<?php echo $conf_texto8_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto8_edit==1){ ?>
                                        <textarea  id="campoTexto8" name="campoTexto8" data-rel="<?php echo $conf_texto8_tit;?>" data-id="<?php echo $conf_texto8_obrigatorio;?>" <?php if($conf_texto8_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto8_codigo>1){ ?>onKeyUp="return  Contador('campoTexto8',<?php echo $conf_texto8_codigo;?>, 'contTexto8');"<?php }; ?>><?php echo $reg['text_texto8'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto8'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto9==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto9_tit;?> <?php if($conf_texto9_codigo>1){ ?><span id="contTexto9">0/<?php echo $conf_texto9_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto9_edit==1){ ?>
                                        <textarea  id="campoTexto9" name="campoTexto9" data-rel="<?php echo $conf_texto9_tit;?>" data-id="<?php echo $conf_texto9_obrigatorio;?>" <?php if($conf_texto9_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto9_codigo>1){ ?>onKeyUp="return  Contador('campoTexto9',<?php echo $conf_texto9_codigo;?>, 'contTexto9');"<?php }; ?>><?php echo $reg['text_texto9'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto9'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_texto10==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_texto10_tit;?> <?php if($conf_texto10_codigo>1){ ?><span id="contTexto10">0/<?php echo $conf_texto10_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_texto10_edit==1){ ?>
                                        <textarea  id="campoTexto10" name="campoTexto10" data-rel="<?php echo $conf_texto10_tit;?>" data-id="<?php echo $conf_texto10_obrigatorio;?>" <?php if($conf_texto10_codigo==1){ ?>class="summernote"<?php }; ?> <?php if($conf_texto10_codigo>1){ ?>onKeyUp="return  Contador('campoTexto10',<?php echo $conf_texto10_codigo;?>, 'contTexto10');"<?php }; ?>><?php echo $reg['text_texto10'];?></textarea> 
                                    <?php }else{ ?>
                                        <div class="mostra" style="min-height:200px;">
                                            <?php echo $reg['text_texto10'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>
                                
                                <?php if($conf_data==1){ ?>
                                <div class="div-duplo input-daterange data">                                	
                                    <div class="div-campo">
                                        <label class="bl"><?php echo $conf_data_tit;?> <?php if($conf_data_codigo>0){ ?>(Inicial)<?php }; ?></label>
                                        <i class="icone calendario">&nbsp;</i>
                                        <input type="text" id="campoData1" name="campoData1" data-rel="<?php echo $conf_data_tit;?><?php if($conf_data_codigo>0){ ?> (Inicial)<?php }; ?>" data-id="<?php echo $conf_data_obrigatorio;?>" class="input-sm form-control " value="<?php if($reg['text_data1']!=''){ echo mostra_data($reg['text_data1']); };?>" />
                                    </div><!-- div-campo -->
                                    <?php if($conf_data_codigo>0){ ?>
                                    <div class="div-campo dir">
                                        <label class="bl"><?php echo $conf_data_tit;?> (Final)</label>
                                        <i class="icone calendario">&nbsp;</i>
                                        <input type="text" id="campoData2" name="campoData2" data-rel="<?php echo $conf_data_tit;?><?php if($conf_data_codigo>0){ ?> (Final)<?php }; ?>" data-id="<?php echo $conf_data_obrigatorio;?>" class="input-sm form-control" value="<?php if($reg['text_data2']!=''){ echo mostra_data($reg['text_data2']); };?>" />
                                    </div><!-- div-campo -->
                                    <?php }; ?>
                                </div><!-- div-duplo -->
                                <?php }; ?>
                                
                                <?php if($conf_hora==1){ ?>
                                <div class="div-duplo">                                	
                                    <div class="div-campo">
                                        <label class="bl"><?php echo $conf_hora_tit;?> <?php if($conf_hora_codigo>0){ ?>(Inicial)<?php }; ?></label>
                                        <i class="icone horario">&nbsp;</i>
                                        <input type="text" id="campoHora1" name="campoHora1" data-rel="<?php echo $conf_hora_tit;?><?php if($conf_hora_codigo>0){ ?> (Inicial)<?php }; ?>" data-id="<?php echo $conf_hora_obrigatorio;?>" class="hora " value="<?php if($reg['text_hora1']!='00:00:00' && $reg['text_hora1']!=''){ echo mostra_hora_simples($reg['text_hora1']); };?>" />
                                    </div><!-- div-campo -->
                                    <?php if($conf_hora_codigo>0){ ?>
                                    <div class="div-campo dir">
                                        <label class="bl"><?php echo $conf_hora_tit;?> (Final)</label>
                                        <i class="icone horario">&nbsp;</i>
                                        <input type="text" id="campoHora2" name="campoHora2" data-rel="<?php echo $conf_hora_tit;?><?php if($conf_hora_codigo>0){ ?> (Final)<?php }; ?>" data-id="<?php echo $conf_hora_obrigatorio;?>" class="hora" value="<?php if($reg['text_hora2']!=''  && $reg['text_hora2']!=''){ echo mostra_hora_simples($reg['text_hora2']); };?>" />
                                    </div><!-- div-campo -->
                                    <?php }; ?>
                                </div><!-- div-duplo -->
                                <?php }; ?>
                                
                                <?php if($conf_selecaosimples==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_selecaosimples_tit;?></label>  
                                    <select id="campoSelectSimples" name="campoSelectSimples" data-rel="<?php echo $conf_selecaosimples_tit;?>" data-id="<?php echo $conf_selecaosimples_obrigatorio;?>" class="seletor ">
                                        <option value="">Escolha...</option>
                                        <?php 
                                        $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaosimples_codigo1." AND text_subm_id=".$conf_selecaosimples_codigo2." AND text_status='1'";
                                        $consulta_selecao = $conexao->consulta($sql_selecao); 
                                        while($reg_selecao = $conexao->busca($consulta_selecao)){ 
                                            $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                            $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                            $tem = $conexao->conta($consulta_relacionamento);
                                            ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem>0 || $reg_selecao['text_id']==$_GET['idtex']){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                        };
                                        ?>
                                    </select>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_selecaosimples2==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_selecaosimples2_tit;?></label>  
                                    <select id="campoSelectSimples2" name="campoSelectSimples2" data-rel="<?php echo $conf_selecaosimples2_tit;?>" data-id="<?php echo $conf_selecaosimples2_obrigatorio;?>" class="seletor ">
                                        <option value="">Escolha...</option>
                                        <?php 
                                        $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaosimples2_codigo1." AND text_subm_id=".$conf_selecaosimples2_codigo2." AND text_status='1'";
                                        $consulta_selecao = $conexao->consulta($sql_selecao); 
                                        while($reg_selecao = $conexao->busca($consulta_selecao)){ 
                                            $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                            $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                            $tem = $conexao->conta($consulta_relacionamento);
                                            ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem>0 || $reg_selecao['text_id']==$_GET['idtex']){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                        };
                                        ?>
                                    </select>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_selecaosimples3==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_selecaosimples3_tit;?></label>  
                                    <select id="campoSelectSimples3" name="campoSelectSimples3" data-rel="<?php echo $conf_selecaosimples3_tit;?>" data-id="<?php echo $conf_selecaosimples3_obrigatorio;?>" class="seletor ">
                                        <option value="">Escolha...</option>
                                        <?php 
                                        $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaosimples3_codigo1." AND text_subm_id=".$conf_selecaosimples3_codigo2." AND text_status='1'";
                                        $consulta_selecao = $conexao->consulta($sql_selecao); 
                                        while($reg_selecao = $conexao->busca($consulta_selecao)){ 
                                            $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                            $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                            $tem = $conexao->conta($consulta_relacionamento);
                                            ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem>0 || $reg_selecao['text_id']==$_GET['idtex']){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                        };
                                        ?>
                                    </select>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_selecaosimples4==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_selecaosimples4_tit;?></label>  
                                    <select id="campoSelectSimples4" name="campoSelectSimples4" data-rel="<?php echo $conf_selecaosimples4_tit;?>" data-id="<?php echo $conf_selecaosimples4_obrigatorio;?>" class="seletor ">
                                        <option value="">Escolha...</option>
                                        <?php 
                                        $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaosimples4_codigo1." AND text_subm_id=".$conf_selecaosimples4_codigo2." AND text_status='1'";
                                        $consulta_selecao = $conexao->consulta($sql_selecao); 
                                        while($reg_selecao = $conexao->busca($consulta_selecao)){ 
                                            $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                            $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                            $tem = $conexao->conta($consulta_relacionamento);
                                            ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem>0 || $reg_selecao['text_id']==$_GET['idtex']){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                        };
                                        ?>
                                    </select>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_selecaosimples5==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_selecaosimples5_tit;?></label>  
                                    <select id="campoSelectSimples5" name="campoSelectSimples5" data-rel="<?php echo $conf_selecaosimples5_tit;?>" data-id="<?php echo $conf_selecaosimples5_obrigatorio;?>" class="seletor ">
                                        <option value="">Escolha...</option>
                                        <?php 
                                        $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaosimples5_codigo1." AND text_subm_id=".$conf_selecaosimples5_codigo2." AND text_status='1'";
                                        $consulta_selecao = $conexao->consulta($sql_selecao); 
                                        while($reg_selecao = $conexao->busca($consulta_selecao)){ 
                                            $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                            $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                            $tem = $conexao->conta($consulta_relacionamento);
                                            ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem>0 || $reg_selecao['text_id']==$_GET['idtex']){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                        };
                                        ?>
                                    </select>
                                </div><!-- div-campo -->
                                <?php }; ?>
                                
                                <?php if($conf_selecaomultipla==1){ ?>
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_selecaomultipla_tit;?></label>  
                                    <select id="campoSelectMultiplo" name="campoSelectMultiplo[]" data-rel="<?php echo $conf_selecaomultipla_tit;?>" data-id="<?php echo $conf_selecaomultipla_obrigatorio;?>" class="seletor " multiple>
                                    	<option value="">Escolha...</option>
										<?php 
										$sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaomultipla_codigo1." AND text_subm_id=".$conf_selecaomultipla_codigo2;
										$consulta_selecao = $conexao->consulta($sql_selecao); 
										while($reg_selecao = $conexao->busca($consulta_selecao)){ 
											$sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
											$consulta_relacionamento = $conexao->consulta($sql_relacionamento);
											$tem2 = $conexao->conta($consulta_relacionamento);
										?>
                                        <option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem2>0 || $reg_selecao['text_id']==$_GET['idtex']){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option>
                                        <?php }; ?>
                                    </select>
                                </div><!-- div-campo -->
                                <?php }; ?>
                                        
                                <?php if($conf_tags==1){  
                                		$vetor_tags = explode(',',$reg['text_tags']);
								?>                              
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_tags_tit;?></label>  
                                    <select data-role="tagsinput" multiple="multiple" id="campoTags" name="campoTags[]" data-rel="<?php echo $conf_tags_tit;?>" data-id="<?php echo $conf_tags_obrigatorio;?>">
                                    	<?php for($i=0; $i<count($vetor_tags); $i++){ ?>
                                      	<option selected="selected" value="<?php echo $vetor_tags[$i];?>" ><?php echo $vetor_tags[$i];?></option>
                                      	<?php }; ?>
                                    </select>
                                </div><!-- div-campo -->
                               <?php }; ?>
                               
                               <?php if($conf_valor==1){ ?>           
                               <div class="div-campo">
                                	<label class="bl"><?php echo $conf_valor_tit;?></label>
                                    <input type="text" id="campoValor" name="campoValor" data-rel="<?php echo $conf_valor_tit;?>" data-id="<?php echo $conf_valor_obrigatorio;?>" class="valor " value="<?php if($reg['text_valor']>0){ echo number_format($reg['text_valor'], 2, ',', '.'); };?>" />
                                </div><!-- div-campo -->
                                <?php }; ?>
                                
                                <?php if($conf_link==1){ ?>           
                                <div class="div-campo">
                                	<label class="bl"><?php echo $conf_link_tit;?></label>
                                    <input type="text" id="campoLink" name="campoLink" data-rel="<?php echo $conf_link_tit;?>" data-id="<?php echo $conf_link_obrigatorio;?>" value="<?php if($reg['text_link']!='' && $reg['text_link']!='http://'){ echo $reg['text_link']; }else{ echo ''; }; ?>" />
                                </div><!-- div-campo -->
                                <?php }; ?>
                                
                                <?php if($conf_info1==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info1_tit;?> <?php if($conf_info1_codigo>0){ ?><span id="contInf1">0/<?php echo $conf_info1_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_info1_edit==1){ ?>
                                        <input type="text" id="campoInfo1" name="campoInfo1" data-rel="<?php echo $conf_info1_tit;?>" data-id="<?php echo $conf_info1_obrigatorio;?>" <?php if($conf_info1_codigo>0){ ?>onKeyUp="return  Contador('campoInfo1',<?php echo $conf_info1_codigo;?>, 'contInf1');"<?php }; ?> value="<?php if($reg['text_info1']!=''){ echo $reg['text_info1']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info1'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info2==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info2_tit;?>  <?php if($conf_info2_codigo>0){ ?><span id="contInf2">0/<?php echo $conf_info2_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_info2_edit==1){ ?>
                                        <input type="text" id="campoInfo2" name="campoInfo2" data-rel="<?php echo $conf_info2_tit;?>" data-id="<?php echo $conf_info2_obrigatorio;?>" <?php if($conf_info2_codigo>0){ ?>onKeyUp="return  Contador('campoInfo2',<?php echo $conf_info2_codigo;?>, 'contInf2');"<?php }; ?> value="<?php if($reg['text_info2']!=''){ echo $reg['text_info2']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info2'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info3==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info3_tit;?> <?php if($conf_info3_codigo>0){ ?><span id="contInf3">0/<?php echo $conf_info3_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_info3_edit==1){ ?>
                                        <input type="text" id="campoInfo3" name="campoInfo3" data-rel="<?php echo $conf_info3_tit;?>" data-id="<?php echo $conf_info3_obrigatorio;?>" <?php if($conf_info3_codigo>0){ ?>onKeyUp="return  Contador('campoInfo3',<?php echo $conf_info3_codigo;?>, 'contInf3');"<?php }; ?> value="<?php if($reg['text_info3']!=''){ echo $reg['text_info3']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info3'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info4==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info4_tit;?> <?php if($conf_info4_codigo>0){ ?><span id="contInf4">0/<?php echo $conf_info4_codigo;?></span><?php }; ?></label>
                                    <?php if($conf_info4_edit==1){ ?>
                                        <input type="text" id="campoInfo4" name="campoInfo4" data-rel="<?php echo $conf_info4_tit;?>" data-id="<?php echo $conf_info4_obrigatorio;?>" <?php if($conf_info4_codigo>0){ ?>onKeyUp="return  Contador('campoInfo4',<?php echo $conf_info4_codigo;?>, 'contInf4');"<?php }; ?> value="<?php if($reg['text_info4']!=''){ echo $reg['text_info4']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info4'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info5==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info5_tit;?></label>
                                    <?php if($conf_info5_edit==1){ ?>
                                        <input type="text" id="campoInfo5" name="campoInfo5" data-rel="<?php echo $conf_info5_tit;?>" data-id="<?php echo $conf_info5_obrigatorio;?>" value="<?php if($reg['text_info5']!=''){ echo $reg['text_info5']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info5'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info6==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info6_tit;?></label>
                                    <?php if($conf_info6_edit==1){ ?>
                                        <input type="text" id="campoInfo6" name="campoInfo6" data-rel="<?php echo $conf_info6_tit;?>" data-id="<?php echo $conf_info6_obrigatorio;?>" value="<?php if($reg['text_info6']!=''){ echo $reg['text_info6']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info6'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info7==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info7_tit;?></label>
                                    <?php if($conf_info7_edit==1){ ?>
                                        <input type="text" id="campoInfo7" name="campoInfo7" data-rel="<?php echo $conf_info7_tit;?>" data-id="<?php echo $conf_info7_obrigatorio;?>" value="<?php if($reg['text_info7']!=''){ echo $reg['text_info7']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info7'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info8==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info8_tit;?></label>
                                    <?php if($conf_info8_edit==1){ ?>
                                        <input type="text" id="campoInfo8" name="campoInfo8" data-rel="<?php echo $conf_info8_tit;?>" data-id="<?php echo $conf_info8_obrigatorio;?>" value="<?php if($reg['text_info8']!=''){ echo $reg['text_info8']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info8'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info9==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info9_tit;?></label>
                                    <?php if($conf_info9_edit==1){ ?>
                                        <input type="text" id="campoInfo9" name="campoInfo9" data-rel="<?php echo $conf_info9_tit;?>" data-id="<?php echo $conf_info9_obrigatorio;?>" value="<?php if($reg['text_info9']!=''){ echo $reg['text_info9']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info9'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>

                                <?php if($conf_info10==1){ ?>           
                                <div class="div-campo">
                                    <label class="bl"><?php echo $conf_info10_tit;?></label>
                                    <?php if($conf_info10_edit==1){ ?>
                                        <input type="text" id="campoInfo10" name="campoInfo10" data-rel="<?php echo $conf_info10_tit;?>" data-id="<?php echo $conf_info10_obrigatorio;?>" value="<?php if($reg['text_info10']!=''){ echo $reg['text_info10']; }else{ echo ''; }; ?>" />
                                    <?php }else{ ?>
                                        <div class="mostra">
                                            <?php echo $reg['text_info10'];?>
                                        </div>
                                    <?php }; ?>
                                </div><!-- div-campo -->
                                <?php }; ?>
                                
                                <?php if($conf_arquivos==1){ ?>                                 		
										<?php 
                                        if($conf_arquivos_codigo==0){
                                            $tipo_arquivos = '*.pdf; *.doc; *.docx; *.xls; *.png; *.jpg; *.mp3; *.mp4; *.gif';
                                        }
                                        if($conf_arquivos_codigo==1){
                                            $tipo_arquivos = '*.png; *.jpg; *.gif';
                                        }
                                        if($conf_arquivos_codigo==2){
                                            $tipo_arquivos = '*.pdf; *.doc; *.xls; *.docx';
                                        }
                                        if($conf_arquivos_codigo==3){
                                            $tipo_arquivos = '*.mp4; *.mp3';
                                        }
                                        if($conf_arquivos_codigo==4){
                                            $tipo_arquivos = '*.pdf';
                                        }
                                        if($conf_arquivos_codigo==5){
                                            $tipo_arquivos = '*.doc; *.docx';
                                        }
                                        if($conf_arquivos_codigo==6){
                                            $tipo_arquivos = '*.xls';
                                        }
                                        if($conf_arquivos_codigo==7){
                                            $tipo_arquivos = '*.png';
                                        }
                                        if($conf_arquivos_codigo==8){
                                            $tipo_arquivos = '*.jpg';
                                        }
                                        if($conf_arquivos_codigo==9){
                                            $tipo_arquivos = '*.gif';
                                        }
                                        if($conf_arquivos_codigo==10){
                                            $tipo_arquivos = '*.mp3';
                                        }
                                        if($conf_arquivos_codigo==11){
                                            $tipo_arquivos = '*.mp4';
                                        }
                                        ?>
                                <!-- Upload Documentos -->
                                <script type="text/javascript">									
									$(function() {
										$('.upload-arquivos').uploadify({
        									'fileTypeExts' : '<?php echo $tipo_arquivos;?>',
											'removeTimeout' : 1,
											'swf'      : 'uploadify.swf',
											'uploader' : 'uploadify.php',
											'method'   : 'post',
    										'formData' : { 'ID' : '<?php echo $id_texto;?>', 'CHAVE' : '<?php echo $chave;?>' },											
											'onQueueComplete' : function(queueData) {
												adicionaArquivos('<?php echo $chave;?>');
											},
											'onUploadSuccess' : function(file, data, response) {
												if(data!=1){
													alert(data);
												}
											}
										});			
									});							
								</script>                               
                                <div class="div-campo">
                                	<label class="bl"><?php echo $conf_arquivos_tit;?> <small>( <?php echo $tipo_arquivos;?> )</small></label>
                                    <input class="upload-arquivos" id="file_upload" name="file_upload" type="file" <?php /*multiple="true" */ ?>>
                                    <div class="div-fila" id="queue"></div><!-- div-fila -->	
                                    
                                    <div class="div-lista-documentos marcado"><!-- colocar classe marcado para aparecer -->
                                    	<ul id="arquivosLista" class="lista-arquivos">                                        	
                                        	<?php
											if($id_texto!=''){
											$consulta_arq = $conexao->consulta("SELECT * FROM tag3_arquivos WHERE arqu_text_id=".addslashes($id_texto)." ORDER BY arqu_ordem ASC"); 
											while($reg_arq = $conexao->busca($consulta_arq)){
											?>                                    	
                                        	<li data-id="<?php echo $reg_arq['arqu_id'];?>" id="arq<?php echo $reg_arq['arqu_id'];?>" >
                                            	<span>
                                                    <i class="icone <?php echo substr($reg_arq['arqu_tipo'],0,3);?>">&nbsp;</i>
                                                    <span id="titArq<?php echo $reg_arq['arqu_id'];?>"><?php echo $reg_arq['arqu_nome'];?>.<?php echo $reg_arq['arqu_tipo'];?></span>
                                                </span>
                                                <div class="div-acoes">
                                                	<a href="javascript:;" class="bt bt-editar tip" data-id="<?php echo $reg_arq['arqu_id'];?>" data-toggle="modal" data-target="#arquivoModal" data-placement="left" title="Editar">Editar</a>
                                                    <a id="visuArq<?php echo $reg_arq['arqu_id'];?>" href="arquivos/download/<?php echo $reg_arq['arqu_nome'];?>.<?php echo $reg_arq['arqu_tipo'];?>" target="_blank" class="bt bt-visualizar tip" data-placement="left" title="Visualizar">Visualizar</a>
                                                    <a href="javascript:removerArquivo(<?php echo $reg_arq['arqu_id'];?>);" class="bt bt-excluir tip" data-placement="left" title="Excluir">Excluir</a>                                                    
                                                </div><!-- div-acoes -->
                                            </li>
                                            <?php };
											}; ?>
                                        </ul>
                                        <input name="ordem-arquivos" type="hidden" />
                                    </div><!-- div-lista-documentos -->
                                </div><!-- div-campo -->
                                <!-- Upload Documentos -->
								<?php }; ?>
                                
                                 <?php if($conf_galeria==1){ ?> 
                                <!-- upload Imagens -->                         
                                <script type="text/javascript">									
									$(function() {
										$('.upload-imagem').uploadify({
        									'fileTypeExts' : '*.jpg;',
											'removeTimeout' : 1,
											'swf'      : 'uploadify.swf',
											'uploader' : 'uploadify_gal.php',
											'method'   : 'post',
    										'formData' : { 'ID' : '<?php echo $id_texto;?>', 'CHAVE' : '<?php echo $chave;?>' },											
											'onQueueComplete' : function(queueData) {
												adicionaImagens('<?php echo $chave;?>');
											},
											'onUploadSuccess' : function(file, data, response) {
												if(data!=1){
													alert(data);
												}
											}
										});			
									});	
															
								</script>                               
                                <div class="div-campo">
                                	<label class="bl"><?php echo $conf_galeria_tit;?> <small>( *.jpg )</small></label>
                                    <input class="upload-imagem" id="file_upload_gal" name="file_upload_gal" type="file" multiple>
                                    <div class="div-fila" id="queue"></div><!-- div-fila -->	
                                    
                                    <div class="div-lista-imagens marcado">
                                        <div class="div-cont-fotos">
                                            <ul id="imagensLista" class="lista-imagem">
                                            	<?php
												if($id_texto!=''){
												$consulta_fot = $conexao->consulta("SELECT * FROM tag3_galeria WHERE foto_text_id=".addslashes($id_texto)." ORDER BY foto_ordem ASC"); 
												while($reg_fot = $conexao->busca($consulta_fot)){
												?>
                                                <li data-id="<?php echo $reg_fot['foto_id'];?>" id="foto<?php echo $reg_fot['foto_id'];?>">
                                                	<span>
                                                    	<a href="javascript:;" class="bt bt-editar" data-id="<?php echo $reg_fot['foto_id'];?>" data-toggle="modal" data-target="#galeriaModal" title="Editar">Editar</a>
                                                    	<a href="javascript:removerImagemGal(<?php echo $reg_fot['foto_id'];?>);" class="bt bt-excluir" title="Excluir">Excluir</a>
                                                    </span>
                                                    <div><img src="arquivos/galeria/thumb_<?php echo $reg_fot['foto_nome']?>.<?php echo $reg_fot['foto_tipo'];?>" width="90" height="90" /></div>
                                                </li>
                                                <?php }; 
												}; ?>                                                                   
                                            </ul>
                                        </div><!-- div-cont-fotos -->
                                        <input name="ordem-imagem" type="hidden" />
                                    </div><!-- div-lista-imagens -->
                                    
                                </div><!-- div-campo -->
                                <!-- upload Imagens -->
                                <?php }; ?>
                                
                                 <?php if($conf_seo==1){ 
										 if($id_texto!=''){
											$consulta_seo = $conexao->consulta("SELECT * FROM tag3_seo WHERE seo_text_id=".addslashes($id_texto)); 
											$reg_seo = $conexao->busca($consulta_seo);
										 }
								 ?> 
                                <!-- SEO -->
                                <div class="div-seo">
                                	<div class="div-titulo"><b>Otimização/SEO</b></div><!-- div-titulo -->
                                    <div class="div-cont">
                                    	<div class="div-nav">
                                        	<ul>
                                            	<li><a href="javascript:;" class="marcado" data-id="bl1">Google</a></li>
                                                <li><a href="javascript:;" data-id="bl2">Facebook</a></li>
                                                <li><a href="javascript:;" data-id="bl3">Twitter</a></li>
                                            </ul>
                                        </div><!-- div-nav -->
                                        <div class="div-bloco">
                                        	<div class="div-item marcado" id="bl1">
                                            	<div class="div-campo">
                                                	<label class="bl">Descrição <small class="tip" data-placement="right" title="Descrição da página. No máximo 155 caracteres.">(?)</small> <span id="contDes">0/155</span></label>
                                                    <input class="campoForm" type="text" id="campoGoogleDesc" name="campoGoogleDesc" maxlength="155" value="<?php echo $reg_seo['seo_google_desc'];?>" />
                                                </div><!-- div-campo -->
                                                <div class="div-campo">
                                                	<label class="bl">Palavra-chave <small class="tip" data-placement="right" title="Palavras que se referem ao conteúdo da página separadas por virgula. No máximo 150 caracteres.">(?)</small> <span>0/150</span></label>
                                                    <input type="text" id="campoGoogleTags" name="campoGoogleTags" maxlength="150" value="<?php echo $reg_seo['seo_google_tags'];?>" />
                                                </div><!-- div-campo -->
                                            </div><!-- div-item -->
                                            
                                            <div class="div-item" id="bl2">
                                            	<div class="div-campo">
                                                	<label class="bl">Título da página <small class="tip" data-placement="right" title="Se quiser um título diferente do título da página no post, quando compartilhar no Facebook.">(?)</small></label>
                                                    <input type="text" id="campoFacebookTitulo" name="campoFacebookTitulo" value="<?php echo $reg_seo['seo_facebook_titulo'];?>" />
                                                </div><!-- div-campo -->
                                                <div class="div-campo">
                                                	<label class="bl">Descrição da página <small class="tip" data-placement="right" title="Se quiser uma descrição diferente da descrição da página no post, quando compartilhar no Facebook">(?)</small> <span>0/200</span></label>
                                                    <input type="text" id="campoFacebookDesc" name="campoFacebookDesc" maxlength="200" value="<?php echo $reg_seo['seo_facebook_desc'];?>" />
                                                </div><!-- div-campo -->
                                                <div class="div-campo">
                                                	<script>
														$(function(){
															var croppicHeaderOptions2 = {
																	uploadUrl:'img_save_to_file_facebook.php',
																	uploadData:{
																		"ID":<?php echo $id_texto;?>,
																		"CHAVE":"<?php echo $chave;?>"
																	},
																	cropData:{
																		"ID":<?php echo $id_texto;?>,
																		"CHAVE":"<?php echo $chave;?>"
																	},
																	cropUrl:'img_crop_to_file_facebook.php',
																	customUploadButtonId:'cropContainerHeaderButton2',
																	modal:false,
																	loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>'
																	/*
																	onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
																	onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
																	onImgDrag: function(){ console.log('onImgDrag') },
																	onImgZoom: function(){ console.log('onImgZoom') },
																	onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
																	onAfterImgCrop:function(){ console.log('onAfterImgCrop') }
																	*/
															}	
															var croppic2 = new Croppic('foto-facebook', croppicHeaderOptions2);
														});
													</script>
                                                	<label class="bl">Imagem <small class="tip" data-placement="right" title="Imagem que aparecerá no post quando compartilhar no Facebook. Resolução 200x200 px">(?)</small></label>
                                                    <div class="div-foto-facebook" id="foto-facebook">
                                                    <?php  if($reg_seo['seo_facebook_imagem']!=''){ ?>
                                                    <img src="arquivos/imagem/<?php echo $reg_seo['seo_facebook_imagem'];?>" style="position:absolute;top:0;left:0;" />
                                                    <?php };  ?>
                                                    </div><!-- div-foto-facebook -->
                                                    <a href="javascript:;" class="botao az" id="cropContainerHeaderButton2">Escolher imagem destaque</a>
                                                </div><!-- div-campo -->
                                            </div><!-- div-item -->
                                            
                                            <div class="div-item" id="bl3">
                                            	<div class="div-campo">
                                                	<label class="bl">Título da página <small class="tip" data-placement="right" title="Se quiser um título diferente do título da página no post do Twittter.">(?)</small></label>
                                                    <input type="text" id="campoTwitterTitulo" name="campoTwitterTitulo" value="<?php echo $reg_seo['seo_twitter_titulo'];?>" />
                                                </div><!-- div-campo -->
                                                <div class="div-campo">
                                                	<label class="bl">Descrição da página <small class="tip" data-placement="right" title="Se quiser uma descrição diferente da descrição da página no post do Twitter">(?)</small> <span>0/200</span></label>
                                                    <input type="text" id="campoTwitterDesc" name="campoTwitterDesc" maxlength="200" value="<?php echo $reg_seo['seo_twitter_desc'];?>" />
                                                </div><!-- div-campo -->
                                                <div class="div-campo">
                                                	<label class="bl">Autor <small class="tip" data-placement="right" title="Conta do Twitter do autor do texto (incluindo arroba)">(?)</small></label>
                                                    <input type="text" id="campoTwitterAutor" name="campoTwitterAutor" value="<?php echo $reg_seo['seo_twitter_autor'];?>" />
                                                </div><!-- div-campo -->
                                                <div class="div-campo">
                                                	<script>
														$(function(){
															var croppicHeaderOptions3 = {
																	uploadUrl:'img_save_to_file_twitter.php',
																	uploadData:{
																		"ID":<?php echo $id_texto;?>,
																		"CHAVE":"<?php echo $chave;?>"
																	},
																	cropData:{
																		"ID":<?php echo $id_texto;?>,
																		"CHAVE":"<?php echo $chave;?>"
																	},
																	cropUrl:'img_crop_to_file_twitter.php',
																	customUploadButtonId:'cropContainerHeaderButton3',
																	modal:false,
																	loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>'
																	/*
																	onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
																	onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
																	onImgDrag: function(){ console.log('onImgDrag') },
																	onImgZoom: function(){ console.log('onImgZoom') },
																	onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
																	onAfterImgCrop:function(){ console.log('onAfterImgCrop') }
																	*/
															}	
															var croppic3 = new Croppic('foto-twitter', croppicHeaderOptions3);
														});
													</script>
                                                	<label class="bl">Imagem <small class="tip" data-placement="right" title="Imagem que aparecerá no post do Twitter. Resolução 200x200 px">(?)</small></label>
                                                    <div class="div-foto-facebook" id="foto-twitter">
													<?php if($reg_seo['seo_twitter_imagem']!=''){ ?>
                                                    <img src="arquivos/imagem/<?php echo $reg_seo['seo_twitter_imagem'];?>" />
                                                    <?php }; ?>
                                                    </div><!-- div-foto-facebook -->
                                                    <a href="javascript:;" class="botao az" id="cropContainerHeaderButton3">Escolher imagem destaque</a>
                                                </div><!-- div-campo -->
                                            </div><!-- div-item -->
                                        </div><!-- div-bloco -->
                                    </div><!-- div-cont -->
                                </div><!-- div-seo -->
                                <!-- SEO -->                                
                                <?php }; ?>
									                       
                                <div class="div-lateral scrollbar">
                                	
                                    <div class="div-espaco">&nbsp;</div>
                                    
                                    <?php if($conf_status==1){ ?> 
                                    <div class="div-campo">
                                        <label class="bl">Status</label>
                                        <select class="seletor" id="campoStatus" name="campoStatus">
                                          <option value="1"  <?php  if($reg['text_status']!='0'){ ?>selected="selected"<?php }; ?>>Ativo</option>
                                          <option value="0" <?php  if($reg['text_status']=='0'){ ?>selected="selected"<?php }; ?>>Inativo</option>
                                        </select>
                                    </div><!-- div-campo -->
                                    <?php }; ?>
                                    
                                    <?php if($conf_datapublicacao==1){ ?>
                                    <div class="div-campo">
                                        <label class="bl">Data da Publicação</label>
                                        <i class="icone calendario">&nbsp;</i>
                                        <input type="text" id="campoDataPublicacao" name="campoDataPublicacao" data-rel="<?php echo $conf_datapublicacao_tit;?>" data-id="<?php echo $conf_datapublicacao_obrigatorio;?>" value="<?php echo  $data; ?>" class="text data" />
                                    </div><!-- div-campo -->
                                    
                                    <div class="div-campo">
                                        <label class="bl">Hora da Publicação</label>
                                        <i class="icone horario">&nbsp;</i>
                                        <input type="text" id="campoHoraPublicacao" name="campoHoraPublicacao" data-rel="<?php echo $conf_datapublicacao_tit;?>" data-id="<?php echo $conf_datapublicacao_obrigatorio;?>" class="text hora" value="<?php echo $hora;?>" />
                                    </div><!-- div-campo -->
                                    <?php }; ?>
                                    
                                    <div class="div-botao-tab">
                                    	<div class="div-carregando">&nbsp;</div>
                                        <a href="javascript:salvarTexto('formTexto');" class="botao vd publicar">Publicar</a>
                                        <?php /*<a href="" class="botao lr">Visualizar</a>*/ ?>                                        
                                    </div><!-- div-botao-tab -->
                                    
                                    <?php if($conf_selecaolateral==1){ ?>
                                    <div class="div-separador">&nbsp;</div><!-- div-separador -->
                                    <div class="div-campo">
                                        <label class="bl"><?php echo $conf_selecaolateral_tit;?></label>
                                        <select id="campoSelecaoLateral" name="campoSelecaoLateral" data-rel="<?php echo $conf_selecaolateral_tit;?>" data-id="<?php echo $conf_selecaolateral_obrigatorio;?>" class="seletor" data-rel="<?php echo $conf_selecaolateral_tit;?>" data-id="<?php echo $conf_selecaolateral_obrigatorio;?>">
                                            <option value="">Escolha...</option>
                                            <?php
                                            $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaolateral_codigo1." AND text_subm_id=".$conf_selecaolateral_codigo2." AND text_status=1";
                                            $consulta_selecao = $conexao->consulta($sql_selecao);
                                            while($reg_selecao = $conexao->busca($consulta_selecao)){
                                                $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                                $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                                $tem2 = $conexao->conta($consulta_relacionamento);
                                                ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem2>0){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                            };
                                            ?>
                                        </select>
                                    </div><!-- div-campo -->
                                    <?php }; ?>

                                    <?php if($conf_selecaolateral2==1){ ?>
                                    <div class="div-separador">&nbsp;</div><!-- div-separador -->
                                    <div class="div-campo">
                                        <label class="bl"><?php echo $conf_selecaolateral2_tit;?></label>
                                        <select id="campoSelecaoLateral2" name="campoSelecaoLateral2" data-rel="<?php echo $conf_selecaolateral2_tit;?>" data-id="<?php echo $conf_selecaolateral2_obrigatorio;?>" class="seletor" data-rel="<?php echo $conf_selecaolateral2_tit;?>" data-id="<?php echo $conf_selecaolateral2_obrigatorio;?>">
                                            <option value="">Escolha...</option>
                                            <?php
                                            $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaolateral2_codigo1." AND text_subm_id=".$conf_selecaolateral2_codigo2." AND text_status=1";
                                            $consulta_selecao = $conexao->consulta($sql_selecao);
                                            while($reg_selecao = $conexao->busca($consulta_selecao)){
                                                $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                                $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                                $tem2 = $conexao->conta($consulta_relacionamento);
                                                ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem2>0){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                            };
                                            ?>
                                        </select>
                                    </div><!-- div-campo -->
                                    <?php }; ?>

                                    <?php if($conf_selecaolateral3==1){ ?>
                                    <div class="div-separador">&nbsp;</div><!-- div-separador -->
                                    <div class="div-campo">
                                        <label class="bl"><?php echo $conf_selecaolateral3_tit;?></label>
                                        <select id="campoSelecaoLateral3" name="campoSelecaoLateral3" data-rel="<?php echo $conf_selecaolateral3_tit;?>" data-id="<?php echo $conf_selecaolateral3_obrigatorio;?>" class="seletor" data-rel="<?php echo $conf_selecaolateral3_tit;?>" data-id="<?php echo $conf_selecaolateral3_obrigatorio;?>">
                                            <option value="">Escolha...</option>
                                            <?php
                                            $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaolateral3_codigo1." AND text_subm_id=".$conf_selecaolateral3_codigo2." AND text_status=1";
                                            $consulta_selecao = $conexao->consulta($sql_selecao);
                                            while($reg_selecao = $conexao->busca($consulta_selecao)){
                                                $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                                $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                                $tem2 = $conexao->conta($consulta_relacionamento);
                                                ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem2>0){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                            };
                                            ?>
                                        </select>
                                    </div><!-- div-campo -->
                                    <?php }; ?>

                                    <?php if($conf_selecaolateral4==1){ ?>
                                    <div class="div-separador">&nbsp;</div><!-- div-separador -->
                                    <div class="div-campo">
                                        <label class="bl"><?php echo $conf_selecaolateral4_tit;?></label>
                                        <select id="campoSelecaoLateral4" name="campoSelecaoLateral4" data-rel="<?php echo $conf_selecaolateral4_tit;?>" data-id="<?php echo $conf_selecaolateral4_obrigatorio;?>" class="seletor" data-rel="<?php echo $conf_selecaolateral4_tit;?>" data-id="<?php echo $conf_selecaolateral4_obrigatorio;?>">
                                            <option value="">Escolha...</option>
                                            <?php
                                            $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaolateral4_codigo1." AND text_subm_id=".$conf_selecaolateral4_codigo2." AND text_status=1";
                                            $consulta_selecao = $conexao->consulta($sql_selecao);
                                            while($reg_selecao = $conexao->busca($consulta_selecao)){
                                                $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                                $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                                $tem2 = $conexao->conta($consulta_relacionamento);
                                                ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem2>0){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                            };
                                            ?>
                                        </select>
                                    </div><!-- div-campo -->
                                    <?php }; ?>

                                    <?php if($conf_selecaolateral5==1){ ?>
                                    <div class="div-separador">&nbsp;</div><!-- div-separador -->
                                    <div class="div-campo">
                                        <label class="bl"><?php echo $conf_selecaolateral5_tit;?></label>
                                        <select id="campoSelecaoLateral5" name="campoSelecaoLateral5" data-rel="<?php echo $conf_selecaolateral5_tit;?>" data-id="<?php echo $conf_selecaolateral5_obrigatorio;?>" class="seletor" data-rel="<?php echo $conf_selecaolateral5_tit;?>" data-id="<?php echo $conf_selecaolateral5_obrigatorio;?>">
                                            <option value="">Escolha...</option>
                                            <?php
                                            $sql_selecao = "SELECT * FROM tag3_textos WHERE text_menu_id=".$conf_selecaolateral5_codigo1." AND text_subm_id=".$conf_selecaolateral5_codigo2." AND text_status=1";
                                            $consulta_selecao = $conexao->consulta($sql_selecao);
                                            while($reg_selecao = $conexao->busca($consulta_selecao)){
                                                $sql_relacionamento = "SELECT * FROM tag3_relacionamentos WHERE rela_pai=".$reg_selecao['text_id']." AND rela_filho=".$reg['text_id'];
                                                $consulta_relacionamento = $conexao->consulta($sql_relacionamento);
                                                $tem2 = $conexao->conta($consulta_relacionamento);
                                                ?><option value="<?php echo $reg_selecao['text_id'];?>" <?php if($tem2>0){ ?>selected="selected"<?php }; ?>><?php echo $reg_selecao['text_titulo'];?></option><?php
                                            };
                                            ?>
                                        </select>
                                    </div><!-- div-campo -->
                                    <?php }; ?>
                                    
                                    <?php
									
                                    if($conf_imagemdestaque==1){										
										if($larImgDest<250){
											$larg = $larImgDest;
										}else{
											$larg = 250;
										}
										$sql_imagem = "SELECT * FROM tag3_imagens WHERE imag_text_id=".$id_texto;
										$consulta_imagem = $conexao->consulta($sql_imagem);
										$reg_imagem = $conexao->busca($consulta_imagem);
										?>
                                        <div class="div-separador">&nbsp;</div><!-- div-separador -->
                                        <div class="div-campo">
                                            <label class="bl"><?php echo $conf_imagemdestaque_tit;?></label>
                                            <div id="div-imagem-destaque" class="div-imagem-destaque" style="display:<?php if($reg_imagem['imag_arquivo']==""){ echo "none"; }else{ echo "block"; }; ?>;width:<?=$larg;?>px;">
                                            	
                                                <img src="arquivos/imagem/<?php echo $reg_imagem['imag_arquivo'];?>" style="display:block;" width="<?=$larg;?>" />
                                            	<div class="div-acoes marcado"><!-- adicionar a classe marcado para apareecer -->
                                                	<a href="" class="bt bt-editar tip" data-toggle="modal" data-target="#destaqueModal" data-placement="top" title="Editar">Editar</a>
                                                    <a href="javascript:excluirImagemDestaque(<?php echo $reg_imagem['imag_id'];?>);" class="bt bt-excluir tip" data-placement="top" title="Excluir">Excluir</a>
                                                </div><!-- div-editar-excluir -->
                                            </div><!-- div-imagem-destaque -->
                                            <input type="hidden" id="campoFotoDestaque" name="campoFotoDestaque" data-rel="<?php echo $conf_imagemdestaque_tit;?>" data-id="<?php echo $conf_imagemdestaque_obrigatorio;?>" value="<?php echo $reg_imagem;?>" />
                                            <a id="botEscolherImg" href="javascript:;" class="botao-destaque botao az" data-toggle="modal" data-target="#destaqueModal">Escolher imagem destaque</a>
                                        </div><!-- div-campo -->
                                        <?php
                                    };
                                    ?>
                                </div><!-- div-lateral -->
                            </form>
                        </div><!-- div-form -->
                    </div><!-- div-main -->
                </div><!-- div-box-aba -->                
                <div class="div-box-aba" id="bx2"></div><!-- div-box-aba -->
                <div class="div-box-aba" id="bx3"></div><!-- div-box-aba -->
            </div><!-- div-conteudo -->
        </div><!-- conteudo -->
<?php
	include('rodape.php');
?>