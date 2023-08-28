<?php
	$noticiasM = 'marcado';
	include('cabeca.php');
	
	//---------CONFIGURANDO O TITULO DA PÁGINA--------------
	$sql_menu = "SELECT menu_titulo, menu_novo, menu_destacar, menu_ativar, menu_editar, menu_excluir FROM tag3_menu WHERE menu_id=".addslashes($_GET['men']);
	$consulta_menu = $conexao->consulta($sql_menu); 
	$reg_menu = $conexao->busca($consulta_menu);	
	$titulo_submenu = $titulo_menu = $reg_menu[0];
	$menu_novo = $reg_menu[1];
	$menu_destacar = $reg_menu[2];
	$menu_ativar = $reg_menu[3];
	$menu_editar = $reg_menu[4];
	$menu_excluir = $reg_menu[5];
	$_SESSION['men']=$_GET['men'];
		
	if($_GET['submen']>0){
		$sql_menu = "SELECT menu_titulo, menu_novo, menu_destacar, menu_ativar, menu_editar, menu_excluir FROM tag3_menu WHERE menu_id=".addslashes($_GET['submen']);
		$consulta_menu = $conexao->consulta($sql_menu); 
		$reg_menu = $conexao->busca($consulta_menu);
		$titulo_submenu = $reg_menu[0];
		$menu_novo = $reg_menu[1];
		$menu_destacar = $reg_menu[2];
		$menu_ativar = $reg_menu[3];
		$menu_editar = $reg_menu[4];
		$menu_excluir = $reg_menu[5];		
		$_SESSION['submen']=$_GET['submen'];		
	}
	
	if($_GET['idcat']>0){
		$medidas = strval($_GET['idcat']);
		$med = explode('.',$medidas);
		$idcat1 = $med[0];
		$idcat2 = intval($med[1]);
		if($idcat2>0){
			$tmp = $idcat1;
			$idcat1 = $idcat2;
			$idcat2 = $tmp;
		}
		$sql_menu = "SELECT menu_titulo, menu_novo, menu_destacar, menu_ativar, menu_editar, menu_excluir FROM tag3_menu WHERE menu_id=".addslashes($idcat1)." AND menu_menu_id=".addslashes($idcat2);
		$consulta_menu = $conexao->consulta($sql_menu); 
		$reg_menu = $conexao->busca($consulta_menu);
		$titulo_submenu = $reg_menu[0];
		$menu_novo = $reg_menu[1];
		$menu_destacar = $reg_menu[2];
		$menu_ativar = $reg_menu[3];
		$menu_editar = $reg_menu[4];
		$menu_excluir = $reg_menu[5];		
		$_SESSION['submen']=$_GET['submen'];		
	}
	//----------FIM CONFIGURAÇÃO DO TÍTULO DA PÁGINA----------
	
	
	//-----------CONSULTA DO CONTEÚDO PRINCIPAL DA PÁGINA------------	
	$filtro='';
	if($_GET['s']=='a'){
		$ativos_marcado = 'marcado';
		$filtro = " AND text_status=1";
	}else if($_GET['s']=='i'){
		$inativos_marcado = 'marcado';
		$filtro = " AND text_status=0";
	}else{
		$tudo_marcado = 'marcado';
		$filtro = '';
	}
	if($_GET['b']!=''){
		$filtro .= ' AND (text_titulo like "%'.addslashes($_GET['b']).'%" or text_resumo like "%'.addslashes($_GET['b']).'%" or text_texto like "%'.addslashes($_GET['b']).'%" or text_texto2 like "%'.addslashes($_GET['b']).'%" or text_texto3 like "%'.addslashes($_GET['b']).'%" or text_texto4 like "%'.addslashes($_GET['b']).'%" or text_texto5 like "%'.addslashes($_GET['b']).'%" or text_tags like "%'.addslashes($_GET['b']).'%" or text_info1 like "%'.addslashes($_GET['b']).'%" or text_info2 like "%'.addslashes($_GET['b']).'%" or text_info3 like "%'.addslashes($_GET['b']).'%" or text_info4 like "%'.addslashes($_GET['b']).'%" or text_info5 like "%'.addslashes($_GET['b']).'%")';
		$definicao_filtro = "Palavra-chave: ".$_GET['b'];
	}
	
	//-----------LIMITE DE REGISTROS POR PÁGINA---------------
	$limite = 20;
	
	if(isset($_GET['pag']) && $_GET['pag']!=""){
		$pagina = $_GET['pag'];
		$mult = $pagina-1;
		$inicio=($mult*$limite);
	}else{
		$pagina = 1;
		$inicio=0;
	}
	
	$campo_ordem = 'text_ordem ASC, text_data_publicacao DESC';	
	if($_GET['submen']>0){
		$id = addslashes($_GET['submen']);
	}else if($_GET['men']>0){
		$id = addslashes($_GET['men']);
	}else{
		$id=0;
	}
	if($_GET['idtex']>0 && $_GET['idcat']>0){
		$id = addslashes($_GET['idcat']);
		$idtext = addslashes($_GET['idtex']);
		$idcate = addslashes($_GET['idcat']);
		
		$medidas = strval($idcate);
		$med = explode('.',$medidas);
		$idcat1 = $med[0];
		$idcat2 = intval($med[1]);
		
		$sql = "SELECT * FROM tag3_relacionamentos, tag3_textos WHERE ((rela_pai=$idtext and rela_filho=text_id) OR (rela_filho=$idtext and rela_pai=text_id)) and text_menu_id=$idcat1 and text_subm_id=$idcat2 $filtro ORDER BY $campo_ordem LIMIT $inicio, $limite";
		//echo $sql;
	}else{
		if($_GET['submen']!=''){
			$sub = addslashes($_GET['submen']);
		}else{
			$sub = 0;
		}
		$sql = "SELECT * FROM tag3_textos WHERE text_menu_id='".addslashes($_GET['men'])."' AND text_subm_id='".$sub."' $filtro ORDER BY $campo_ordem LIMIT $inicio, $limite";
		//echo $sql;
	}
	$consulta = $conexao->consulta($sql); 
	//-----------FIM DA CONSULTA DO CONTEÚDO PRINCIPAL DA PÁGINA---------
?>        
        
        <script>
			$(window).bind('scroll',function(e){var lar = $('.div-cont-header').width();var alt = $('.div-cont-header').height();var dist = $('.div-tabela').offset();if( $(document).scrollTop() >= dist.top ) {$('.div-tabela').css({'padding-top' : alt});$('.div-cont-header').addClass('fixo');$('.div-cont-header').css({'width' : lar});}else if($(document).scrollTop() <= dist.top){$('.div-tabela').css({'padding-top' : 0});$('.div-cont-header').removeClass('fixo');$('.div-cont-header').css({'width' : '100%'})}});
			$(function() {				
				$('#nestable').nestable({group:1,maxDepth:0}).on('change', function(){					
					var ordem = '';
					$('.dd-item').each(function() {
						if(ordem==''){
							ordem = $(this).attr('data-id');	
						}else{
							ordem = ordem + ',' + $(this).attr('data-id');	
						}
					});	
					$.ajax({						
						type: "POST",
						data: { VALORES:ordem },						
						url: "acoes/ordenar.php",
						dataType: "html",
						success: function(result){
							$("#nestable-output").val(ordem); 							
						}
				   });			
				});
			});
			atualizadados(<?php echo $_GET['men'];?>,'<?php echo $sub;?>',<?php if($_GET['idcat']!=''){ echo $_GET['idcat']; }else{ echo '0'; };?>,<?php if($_GET['idtex']!=''){ echo $_GET['idtex']; }else{ echo '0'; };?>,'<?php if($_GET['s']!=''){ echo $_GET['s']; }else{ echo '0'; };?>','<?php if($_GET['b']!=''){ echo $_GET['b']; }else{ echo ''; };?>');
			paginar(<?php echo $_GET['men'];?>,'<?php echo $sub;?>',<?php if($_GET['idcat']!=''){ echo $_GET['idcat']; }else{ echo '0'; };?>,<?php if($_GET['idtex']!=''){ echo $_GET['idtex']; }else{ echo '0'; };?>,'<?php if($_GET['s']!=''){ echo $_GET['s']; }else{ echo '0'; };?>','<?php if($_GET['b']!=''){ echo $_GET['b']; }else{ echo ''; };?>',<?php if($_GET['pag']!=''){ echo $_GET['pag']; }else{ echo '1'; };?>,<?php echo $limite;?>);
        </script>
        
        
        <!-- Modal editar arquivo -->
        <div class="modal fade" id="importarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">Importar Arquivos</h4>
              </div><!-- modal-header -->
              <div class="modal-body">
                   
				   <script type="text/javascript">									
						$(function() {
							$('.upload-importar').uploadify({
								'fileTypeExts' : '*.png; *.jpg; *.jpeg; *.gif',
								'removeTimeout' : 1,											
								'swf'      : 'uploadify.swf',
								'uploader' : 'uploadify.php',											
								'onQueueComplete' : function(queueData) {
									$('#importarModal').modal('hide');
								}
							});
						});
					</script>
                    <div class="div-form-modal">
                    	<div class="div-campo">
                            <label class="bl">Importar arquivos <small>( jpg, png, gif )</small></label>
                            <input class="upload-importar" id="upload2" name="upload2" type="file" multiple>             
                        </div><!-- div-campo -->
                    </div><!-- div-form-modal -->
              	                
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Aplicar Alteração</button>
              </div><!-- modal-footer -->
            </div><!-- modal-content -->
          </div><!-- modal-dialog -->
        </div><!-- modal -->
        <!-- Modal editar arquivo -->
        
        <div id="conteudo">
        	
            <?php include('topo.php'); ?>
            
            <div class="div-conteudo">
            	
                <h1><i>&nbsp;</i><?php echo $titulo_menu;?></h1>
                
                
                <div class="div-abas">
                	<div class="div-cont-abas" id="cont-abas">
                        <ul class="ul-abas ulabas">
                            <li><a href="lista.php?men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>" <?php if($_GET['idtex']=='' || $_GET['idtex']==0){?>class="marcado"<?php }; ?> data-id="bx1"> <?php if($_GET['idtex']>0){?><< voltar<?php }else{ ?><?php echo $titulo_submenu;?><?php }; ?></a></li>
                            <?php if($_GET['idtex']>0){
							$sql_titulo_not = "SELECT * FROM tag3_textos WHERE text_id=".addslashes($_GET['idtex']);
							$consulta_titulo_not = $conexao->consulta($sql_titulo_not); 
							$reg_titulo_not = $conexao->busca($consulta_titulo_not);
							?>
                            <li><a href="form.php?id=<?php echo $_GET['idtex'];?>" class="marcado" data-id="bx2"><?php echo $reg_titulo_not['text_titulo'];?></a></li>
                            <?php }; ?>
                        </ul><!-- ul-abas -->    
                                            
                    </div><!-- div-cont-abas -->
                </div><!-- div-abas -->
                
                <div class="div-box-aba marcado" id="bx1">                	
                    					                    
                    <div class="div-main">                  	
                        <div class="div-callback">
                       		<?php if(is_numeric($_GET['slv']) && $_GET['slv']==1){ ?>
                            	<script>fecharMsg();</script>
                        		<div class="div-mensagem sucesso">Texto salvo com sucesso!<a href="javascript:;" class="bt bt-fechar">Fechar</a></div><!-- div-mensagem -->
                            <?php }elseif(is_numeric($_GET['slv']) && $_GET['slv']==0){ ?>
                            	<script>fecharMsg();</script>
                        		<div class="div-mensagem erro">Erro ao publicar, tente novamente.<a href="javascript:;" class="bt bt-fechar">Fechar</a></div><!-- div-mensagem -->
                            <?php }; ?>
                            <?php /*<div class="div-mensagem erro">Exemplo de mensagem de erro<a href="javascript:;" class="bt bt-fechar">Fechar</a></div><!-- div-mensagem -->
                            <div class="div-mensagem alerta">Exemplo de mensagem de alerta<a href="javascript:;" class="bt bt-fechar">Fechar</a></div><!-- div-mensagem -->
							*/ ?>
                        </div><!-- div-callback -->
                              	                        
                        <form id="" name="" method="" action="">
                            <div class="div-tabela">                                	
                                    
                                    <div class="div-cont-header">
                                    	
                                        <div class="div-row">                        					
                                            <?php //if($_GET['idcat']==""){ ?>
                                            <div class="div-indice"><a href="?men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>&idtex=<?php echo $_GET['idtex'];?>&idcat=<?php echo $_GET['idcat'];?>&s=" class="td <?php echo $tudo_marcado;?>">Tudo <span id="total">(0)</span></a> | <a href="?men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>&idtex=<?php echo $_GET['idtex'];?>&idcat=<?php echo $_GET['idcat'];?>&s=a" class="at <?php echo $ativos_marcado;?>">Ativos <span id="ativos">(0)</span></a> | <a href="?men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>&idtex=<?php echo $_GET['idtex'];?>&idcat=<?php echo $_GET['idcat'];?>&s=i" class="in <?php echo $inativos_marcado;?>">Inativos <span id="inativos">(0)</span></a></div><!-- div-indice --> 
                                             <?php //}; ?>                                                                                      
                                            <div class="div-buscar">
                                                <form id="form-buscar" name="form-buscar" method="get" action="lista.php?men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>">
                                                	<input type="hidden" id="men" name="men" value="<?php echo $_SESSION['men'];?>"  />
                                                    <input type="hidden" id="submen" name="submen" value="<?php echo $_SESSION['submen'];?>"  />
                                                    <input type="hidden" id="idtex" name="idtex" value="<?php echo $_GET['idtex'];?>"  />
                                                    <input type="hidden" id="idcat" name="idcat" value="<?php echo $_GET['idcat'];?>"  />
                                                    <input type="text" id="b" name="b" placeholder="Pesquisar..."  onkeypress="detectaEnterBusca(event);" />
                                                    <a href="javascript:if(document.getElementById('b').value!='Pesquisar...'){ window.open('?men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>&b='+document.getElementById('b').value, '_self');};" class="bt bt-buscar"><i>&nbsp;</i></a>
                                                </form>
                                            </div><!-- div-buscar -->
                                        </div><!-- div-row -->
                                        
                                        <div class="div-row">
                                        	<?php
                                        	if($menu_novo==1){
                                        		?><a href="form.php?men=<?php echo $_GET['men'];?>&submen=<?php echo $sub;?>&idtex=<?php echo $_GET['idtex'];?>&idcat=<?php echo $_GET['idcat'];?>" class="botao lr">+ Novo registro</a><?php
                                        	}
                                        	/*
                                            <a href="javascript:;" class="botao az" data-toggle="modal" data-target="#importarModal"><i class="icone importar">&nbsp;</i>Importar</a>
                                            <a href="impressao.php" class="botao vd" target="_blank"><i class="icone exportar">&nbsp;</i>Exportar</a>
                                            */
                                            ?>
											<div class="div-acoes">
                                            	<?php if($menu_excluir==1){ ?>
                                                <a href="javascript:removerselecionados(<?php echo $_GET['men'];?>,<?php echo $_GET['submen'];?>,<?php if($_GET['idcat']!=''){ echo $_GET['idcat']; }else{ echo '0'; };?>);" class="bt excluir tip" data-toggle="tooltip" data-placement="bottom" title="Excluir">Excluir</a>
                                                <?php }; ?>
                                                <?php if($menu_ativar==1){ ?>
                                                <a href="javascript:ativarselecionados(<?php echo $_GET['men'];?>,<?php echo $_GET['submen'];?>,<?php if($_GET['idcat']!=''){ echo $_GET['idcat']; }else{ echo '0'; };?>);" class="bt ativar tip" id="ativar-marcado" data-toggle="tooltip" data-placement="bottom" title="Ativar">Ativar</a>
                                                <a href="javascript:desativarselecionados(<?php echo $_GET['men'];?>,<?php echo $_GET['submen'];?>,<?php if($_GET['idcat']!=''){ echo $_GET['idcat']; }else{ echo '0'; };?>);" class="bt inativar tip" id="desativar-marcado" data-toggle="tooltip" data-placement="bottom" title="Desativar">Desativar</a>
                                                <?php }; ?>                                
                                            </div><!-- div-acoes -->    
                                            
                                            <div id="div-paginacao" class="paginacao">
                                            	<?php /*
                                            	<span style="margin-right:10px;"><i>38 itens</i></span>
                                            	<a href="" class="primeiro desativado"></a>
                                                <a href="" class="anterior desativado"></a>
                                                <input type="text" value="1" id="" name="" />
                                                <span>de 8</span>
                                                <a href="" class="proximo"></a>
                                                <a href="" class="ultimo"></a>
												*/ ?>
                                            </div><!-- paginacao -->
											
                                        </div><!-- div-row -->
                                        
                                        <div class="div-header-tabela">
                                            <?php if($menu_excluir==1 || $menu_ativar==1){ ?>
                                            	<div class="div-cell" style="width:5%;"><div class="div-checkbox check-all"><a href="javascript:;"></a></div></div><!-- div-cell --> 
                                            <?php }; ?>
											<?php //--------------CONSTRUINDO O TOPO DA LISTA PELAS CONFIGURAÇÕES--------------
											if($_GET['idcat']!='' && $_GET['idcat']!=0){
												
												$idcate = addslashes($_GET['idcat']);
		
												$medidas = strval($idcate);
												$med = explode('.',$medidas);
												$men = $med[0];
												$submen = intval($med[1]);
												//$men = $_GET['idcat'];
												//$submen = 0;
											}else{
												$men = $_GET['men'];
												$submen = $sub;
											}
											$sql_conf = "SELECT * FROM tag3_config_listas WHERE lista_menu_id=".addslashes($men)." AND lista_subm_id=".addslashes($submen)." ORDER BY lista_ordem ASC";
											$consulta_conf = $conexao->consulta($sql_conf); 											
											while($reg_conf = $conexao->busca($consulta_conf)){
											?>                                           
                                            <div class="div-cell" style="width:<?php echo $reg_conf['lista_porc'];?>%;text-align:<?php echo $reg_conf['lista_align'];?>;"><?php echo $reg_conf['lista_titulo'];?></div><!-- div-cell -->                                            
                                            <?php };
												//------------FIM DA CONSTRUÇÃO DO TOPO DA LISTA--------------
											?>
                                            
											<?php if($menu_destacar==1 || $menu_ativar==1|| $menu_editar==1 || $menu_excluir==1){ ?>
                                            	<div class="div-cell" style="width:10%;text-align:center;">Ações</div><!-- div-cell -->
                                            <?php }; ?>
                                        </div><!-- div-header-tabela -->
                                    </div><!-- div-cont-header -->
                                    
                                    <div class="div-cont-body dd" id="nestable">
                                    
                                        <ul class="ul-conteudo-tabela dd-list">
                                            
                                            <?php while($reg = $conexao->busca($consulta)){  ?>
                                            <li id="<?php echo  $reg['text_id']; ?>" class="dd-item" data-id="<?php echo  $reg['text_id']; ?>">
                                            	<span class="sp-drag dd-handle">&nbsp;</span>
                                                <div class="div-linha">

													<?php if($menu_excluir==1 || $menu_ativar==1){ ?>
														<div class="div-cell borda" style="width:5%;"><div class="div-checkbox check"><a id="acheck<?php echo $reg["text_id"]; ?>" href="javascript:checar(<?php echo $reg["text_id"]; ?>);"></a><input type="checkbox"  id="check<?php echo $reg["text_id"]; ?>" name="registro[]" value="<?php echo $reg["text_id"]; ?>" /></div></div><!-- div-cell -->
													<?php }; ?>  
											
													<?php //--------------CONSTRUINDO A LISTA PELAS CONFIGURAÇÕES--------------
													$sql_conf = "SELECT * FROM tag3_config_listas WHERE lista_menu_id=".addslashes($men)." AND lista_subm_id=".addslashes($submen)." ORDER BY lista_ordem ASC";
													//echo $sql_conf;
													$consulta_conf = $conexao->consulta($sql_conf); 
													while($reg_conf = $conexao->busca($consulta_conf)){
														
														$id_link = $reg['text_id'];
														$campo_conteudo = $reg_conf['lista_conteudo'];
														$valor_conteudo = $reg[$reg_conf['lista_conteudo']];
														$pagina_abrir = "form.php?id=".$id_link."&men=".$_GET['men']."&submen=".$_GET['submen']."&idtex=".$_GET['idtex']."&idcat=".$_GET['idcat'];
														
														if($reg_conf['lista_menu2_id']!=''){
															
															$id_link = $reg_conf['lista_menu2_id'];
															
															if($reg_conf['lista_conteudo']!='lista'){
																
																$temp = explode('.',strval($id_link));
																$menu = (int)$temp[0];
																$subm = (int)$temp[1];

																$sql_outro = "SELECT (SELECT ".$reg_conf['lista_conteudo']." FROM tag3_textos WHERE rela_pai=text_id) as titulo FROM tag3_relacionamentos, tag3_textos WHERE text_id=rela_filho and text_id=".$reg['text_id']." and rela_pai IN (SELECT text_id FROM tag3_textos WHERE text_menu_id=".$menu." AND text_subm_id=".$subm.")";
																$consulta_outro = $conexao->consulta($sql_outro); 
																$reg_outro = $conexao->busca($consulta_outro);
																$valor_conteudo = $reg_outro[0];
															}else{
																$valor_conteudo = "listar";
																$pagina_abrir = "lista.php?men=".$_GET['men']."&submen=".$_GET['submen']."&idtex=".$reg['text_id']."&idcat=".$id_link;
															}
														}
														
														$conteudo = "";
														if($reg_conf['lista_link']==1){
															$conteudo .= "<a href='".$pagina_abrir."'>";
														}
														$conteudo_bd = formata_campo($campo_conteudo,$valor_conteudo);
														if($reg_conf['lista_limite']!=0){
															$conteudo_bd = substr($conteudo_bd,0,$reg_conf['lista_limite'])."[..]";
														}
														$conteudo .= $conteudo_bd;
														if($reg_conf['lista_link']==1){
															$conteudo .= "</a>";
														}
														
														//--------------INICIO DA CONDIÇÃO ESPECIAL--------------------------
														if($men==1 && $submen==2 && $campo_conteudo=="text_resumo"){
															$conteudo = "<a href=\"visualizar.php?id=".$reg['text_id']."\">visualizar</a>";
															$conteudo .= "<a href=\"enviar.php?id=".$reg['text_id']."\">enviar agora</a>";
														}
														//--------------FIM DA CONDIÇÃO ESPECIAL--------------------------
													?> 
                                                    <div class="div-cell" style="width:<?php echo $reg_conf['lista_porc'];?>%;text-align:<?php echo $reg_conf['lista_align'];?>"><?php echo $conteudo; ?></div><!-- div-cell -->  
                                                    <?php }; ?>
                                                    
													<?php //--------------FIM DA CONSTRUÇÃO DA LISTA-------------------------- ?>
                                                    
                                                    <?php if($menu_destacar==1 || $menu_ativar==1|| $menu_editar==1 || $menu_excluir==1){ ?>
	                                                    <div class="div-cell" style="width:10%;">
	                                                        <div class="div-acao">
	                                                        	<?php if($menu_destacar==1){ ?>
	                                                            <a id="n<?php echo $reg['text_id']; ?>" href="javascript:mudadestaque(<?php echo $reg['text_id']; ?>,1);" class="bt ndestaque <?php if($reg['text_destaque']==1){ ?>esconde<?php }; ?> tip" data-toggle="tooltip" data-placement="top" title="Destacar">Destaque</a>
	                                                            <a id="d<?php echo $reg['text_id']; ?>" href="javascript:mudadestaque(<?php echo $reg['text_id']; ?>,0);" class="bt destaque <?php if($reg['text_destaque']==0){ ?>esconde<?php }; ?> tip" data-toggle="tooltip" data-placement="top" title="Destacar">Destaque</a>
	                                                            <?php }; ?>
	                                                            <?php if($menu_ativar==1){ ?>
	                                                            <a id="i<?php echo $reg['text_id']; ?>" href="javascript:mudastatus(<?php echo $reg['text_id']; ?>,1,<?php echo $_GET['men'];?>,<?php echo $_GET['submen'];?>,<?php if($_GET['idcat']!=''){ echo $_GET['idcat']; }else{ echo '0'; };?>,<?php if($_GET['idtex']!=''){ echo $_GET['idtex']; }else{ echo '0'; };?>,'<?php echo $_GET['b']; ?>');" class="bt inativo <?php if($reg['text_status']==1){ ?>esconde<?php }; ?> tip" data-toggle="tooltip" data-placement="top" title="Ativar">Inativo</a>
	                                                            <a id="a<?php echo  $reg['text_id']; ?>" href="javascript:mudastatus(<?php echo $reg['text_id']; ?>,0,<?php echo $_GET['men'];?>,<?php echo $_GET['submen'];?>,<?php if($_GET['idcat']!=''){ echo $_GET['idcat']; }else{ echo '0'; };?>,<?php if($_GET['idtex']!=''){ echo $_GET['idtex']; }else{ echo '0'; };?>,'<?php echo $_GET['b']; ?>');" class="bt ativo <?php if($reg['text_status']==0){ ?>esconde<?php }; ?> tip" data-toggle="tooltip" data-placement="top" title="Ativar">Ativo</a>                                                                                                       
	                                                            <?php }; ?>
	                                                            <?php if($menu_editar==1){ ?>
	                                                            <a href="form.php?id=<?php echo  $reg['text_id'];?>&men=<?php echo $_GET['men'];?>&submen=<?php echo $_GET['submen'];?>&idtex=<?php echo $_GET['idtex'];?>" class="bt editar tip" data-toggle="tooltip" data-placement="top" title="Editar">Editar</a>
	                                                            <?php }; ?>
	                                                            <?php if($menu_excluir==1){ ?>
	                                                            <a href="javascript:remover(<?php echo $reg['text_id'];?>,<?php echo $_GET['men'];?>,<?php echo $_GET['submen'];?>,<?php if($_GET['idcat']!=''){ echo $_GET['idcat']; }else{ echo '0'; };?>,<?php if($_GET['idtex']!=''){ echo $_GET['idtex']; }else{ echo '0'; };?>);" class="bt excluir tip" data-toggle="tooltip" data-placement="top" title="Excluir">Excluir</a> 
	                                                            <?php }; ?>
	                                                        </div><!-- div-acao -->
	                                                    </div><!-- div-cell -->
	                                                <?php }; ?>
                                                </div><!-- div-linha -->
                                            </li>
                                            <?php $i++; }; ?>
                                            
                                        </ul><!-- ul-conteudo-tabela -->
                                        <input type="hidden" id="nestable-output" />
                                    </div><!-- div-cont-body -->
                                    
                                    <div class="div-row">
                                        <div id="div-paginacao2" class="paginacao" style="padding-top:10px;">
                                        	<?php /*
                                            <span style="margin-right:10px;"><i>38 itens</i></span>
                                            <a href="" class="primeiro desativado"></a>
                                            <a href="" class="anterior desativado"></a>
                                            <input type="text" value="1" id="" name="" />
                                            <span>de 8</span>
                                            <a href="" class="proximo"></a>
                                            <a href="" class="ultimo"></a>
											*/ ?>
                                        </div><!-- paginacao -->
                                    </div><!-- div-row -->
                                                             
                            </div><!-- div-tabela -->                        
                        </form>
                                                       
                    </div><!-- div-main -->
                    
                </div><!-- div-box-aba -->                
                
                <div class="div-box-aba" id="bx2"></div><!-- div-box-aba -->
                
                <div class="div-box-aba" id="bx3"></div><!-- div-box-aba -->
                
            </div><!-- div-conteudo -->
        
        </div><!-- conteudo -->
        
<?php
	include('rodape.php');
?>