<?php
	$painelM = 'marcado';
	include('cabeca.php')
?>        
        
        <script>
			$(function() {
			/* TOUR */
					var myTour = jTour([
						{
							html: "<h1 style='text-align:center;'>Bem vindo ao Tour Admin tag3</h1><hr>This example shows you many different possibilities how to use it"
						},{
							html: "Nessa área serão exibidas<br />algumas informações<br />sobre o usuário logado.",
							expose: true,
							element: $('div').eq(3),
							position: 'se'
						},{
							html: "Clicando na foto você será redirecionado para a página<br />onde poderá editar as informações de usuário.",
							expose: true,
							element: $('.div-perfil'),
							position: 'sw'
						},{
							html: "Essa é a área do calendário.",
							expose: true,
							element: $('.div-data-painel'),
							position: 'sw'
						},{
							html: "Clicando aqui você<br />será redirecionado para<br />o painel do admin.",
							expose: true,
							element: $('.div-data-painel'),
							position: 'se'
						},{
							html: "Aqui fica a área de navegação do admin.",
							expose: true,
							element: $('ul').eq(0),
							position: 'nw'
						}
						
					],{
						axis:'y',  // use only one axis prevent flickring on iOS devices
						onStop:function(){
						},
						onChange:function(current){
						},
						onFinish:function(current){
						},
						animationIn: 'slideDown',
						animationOut: 'hide',
						easing: 'easeInOutExpo', //requires the jquery.easing plugin
						scrollDuration: 600
					}); 
					
					$('#starttour').click(function(){
						myTour.start();
					});
								
					//used in this example
					var myText = "Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores.";
			});
        </script>
        
        <div id="conteudo">
        	
            <?php include('topo.php'); ?>
            
            <div class="div-conteudo">
            	
                <h1><i>&nbsp;</i>GRÁFICO ANALÍTICO DO SITE</h1>
                
                <div class="div-abas">
                	<div class="div-cont-abas" id="cont-abas">
                        <ul class="ul-abas ulabas">
                            <li><a href="javascript:;" class="marcado" data-id="bx1">Categoria da Aba 1</a></li>
                            <li><a href="javascript:;" data-id="bx2">Categoria da Aba 2</a></li>
                            <li><a href="javascript:;" data-id="bx3">Categoria da Aba 3</a></li>
                        </ul><!-- ul-abas -->
                        <div class="div-mais-abas cont-drop">
                            <a href="javascript:;" class="bt-mais-abas link-drop"><i class="detalhe">&nbsp;</i></a>
                            <div class="div-drop drop-abas">
                            	<i class="seta">&nbsp;</i>
                            	<ul class="ulabas">
                                	<li><a href="javascript:;" data-id="bx1">Categoria da Aba 1</a></li>
                                    <li><a href="javascript:;" data-id="bx2">Categoria da Aba 2</a></li>
                                    <li><a href="javascript:;" data-id="bx3">Categoria da Aba 3</a></li>

                                </ul>
                            </div><!-- div-drop -->
                        </div><!-- div-mais-abas -->
                    </div><!-- div-cont-abas -->
                </div><!-- div-abas -->
                
                <div class="div-box-aba marcado" id="bx1">                	
                    
					<script type="text/javascript">
						$(function () {
								$('#visita-mes').highcharts({
									chart: { type: 'areaspline',backgroundColor: '#E2EFF3',marginTop: 40},
									colors: ['#F5B361'],
									title: { text: '' },
									legend: { layout: 'vertical',align: 'right',verticalAlign: 'top',x:-10,y: 0,floating: true,borderWidth: 0,backgroundColor: '#E2EFF3' },
									xAxis: { categories: ['JAN','FEV','MAR','ABR','MAI','JUN','JUL','AGO','SET','OUT','NOV','DEZ'] },
									yAxis: { title: {text: ''}},
									tooltip: { headerFormat: '',pointFormat: '{point.y}',borderWidth: 0,backgroundColor: '#354052',shadow: false,style: {color: '#ffffff', fontWeight: 'bold',textAlign: 'center'}},
									credits: { enabled: false },
									plotOptions: { areaspline: {fillOpacity: 0.5}},
									series: [{name: 'Visitas por mês:',data: [500, 120, 150, 200, 300, 80, 250, 400, 120, 150, 300, 500]}]
								});								
								$('#visita-dia').highcharts({
									chart: {type: 'column',backgroundColor: '#E2EFF3',marginTop: 40},
									colors: ['#47BAC1'],
									title: {text: ''},
									subtitle: {text: ''},
									legend: { layout: 'vertical',align: 'right',verticalAlign: 'top',x:-10,y: 0,floating: true,borderWidth: 0,backgroundColor: '#E2EFF3' },
									xAxis: {categories: ['Do','Se','Te','Qu','Qu','Se','Sa']},
									yAxis: {min: 0,title: {text: ''}},
									tooltip: { headerFormat: '',pointFormat: '{point.y}',borderWidth: 0,backgroundColor: '#354052',shadow: false,style: {color: '#ffffff', fontWeight: 'bold',textAlign: 'center'}},
									credits: { enabled: false },
									plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}},
									series: [{name: 'Visitas por dia',data: [50, 30, 10, 25, 85, 15, 60]}]
								});								
							});
					</script>                    
                    <div class="div-graficos">
                    	<div class="div-cont">
                        	<div class="div-grafico-visita-mes" id="visita-mes"></div><!-- div-grafico-visita-mes -->
                            <div class="div-grafico-visita-dia" id="visita-dia"></div><!-- div-grafico-visita-mes -->
                        </div><!-- div-cont -->
                    </div><!-- div-graficos -->
                    
                    <div class="div-main">
                    	
                        <div class="div-box">
                        	
                            <div class="div-acesso">
                                  <h2>ACESSO <div class="div-data"><i>&nbsp;</i><?php echo date('d/m/Y'); ?></div><!-- div-data --></h2>
                                  <div class="div-visita">
                                  	  <h3><i class="visitas">&nbsp;</i>Visitas</h3>
                                      <div class="div-total">2.569</div><!-- div-total -->
                                      <div class="div-inf">
                                      	 <h4><b>Último Mês</b></h4>
                                         <span>2.229</span>
                                         <div class="div-crescimento"><i class="positivo">&nbsp;</i>3.5%</div><!-- div-crescimento -->
                                      </div><!-- div-inf -->
                                      <div class="div-inf">
                                      	 <h4><b>Média</b></h4>
                                         <span>1.342</span>
                                         <div class="div-crescimento"><i class="positivo">&nbsp;</i>3.5%</div><!-- div-crescimento -->
                                      </div><!-- div-inf -->
                                  </div><!-- div-visita -->
                                  
                                  <div class="div-duracao">
                                  	  <h3><i class="duracao">&nbsp;</i>Duração</h3>
                                      <div class="div-total">00:05:07</div><!-- div-total -->
                                      <div class="div-inf">
                                      	 <h4><b>Último Mês</b></h4>
                                         <span>00:04:45</span>
                                         <div class="div-crescimento"><i class="positivo">&nbsp;</i>3.5%</div><!-- div-crescimento -->
                                      </div><!-- div-inf -->
                                      <div class="div-inf">
                                      	 <h4><b>Média</b></h4>
                                         <span>00:03:34</span>
                                         <div class="div-crescimento"><i class="negativo">&nbsp;</i>-1.8%</div><!-- div-crescimento -->
                                      </div><!-- div-inf -->
                                  </div><!-- div-duracao -->
                            </div><!-- div-acesso -->
                            
                            <div class="div-notificacao">
                            	<h2>AÇÕES</h2>
                                <ul class="scrollbar">
                                	<li>
                                    	<div class="div-foto"><img src="images/foto-padrao50x50.png" width="50" height="50" /><img src="images/maks-acoes.png" class="mask" width="50" height="50" title="Nome do Usuário" /></div><!-- div-foto -->
                                        <span>Rogério Nunes</span><br />Cadastrou 1 Galeria<br />18/01/14
                                    </li>
                                    <li>
                                    	<div class="div-foto"><img src="images/foto-padrao50x50.png" width="50" height="50" /><img src="images/maks-acoes.png" class="mask" width="50" height="50" title="Nome do Usuário" /></div><!-- div-foto -->
                                        <span>Rogério Nunes</span><br />Cadastrou 1 Galeria<br />18/01/14
                                    </li>
                                    <li>
                                    	<div class="div-foto"><img src="images/foto-padrao50x50.png" width="50" height="50" /><img src="images/maks-acoes.png" class="mask" width="50" height="50" title="Nome do Usuário" /></div><!-- div-foto -->
                                        <span>Rogério Nunes</span><br />Cadastrou 1 Galeria<br />18/01/14
                                    </li>
                                    <li>
                                    	<div class="div-foto"><img src="images/foto-padrao50x50.png" width="50" height="50" /><img src="images/maks-acoes.png" class="mask" width="50" height="50" title="Nome do Usuário" /></div><!-- div-foto -->
                                        <span>Rogério Nunes</span><br />Cadastrou 1 Galeria<br />18/01/14
                                    </li>
                                    <li>
                                    	<div class="div-foto"><img src="images/foto-padrao50x50.png" width="50" height="50" /><img src="images/maks-acoes.png" class="mask" width="50" height="50" title="Nome do Usuário" /></div><!-- div-foto -->
                                        <span>Rogério Nunes</span><br />Cadastrou 1 Galeria<br />18/01/14
                                    </li>
                                    <li>
                                    	<div class="div-foto"><img src="images/foto-padrao50x50.png" width="50" height="50" /><img src="images/maks-acoes.png" class="mask" width="50" height="50" title="Nome do Usuário" /></div><!-- div-foto -->
                                        <span>Rogério Nunes</span><br />Cadastrou 1 Galeria<br />18/01/14
                                    </li>
                                </ul>
                            </div><!-- div-notificacao -->
                            
                        </div><!-- div-box -->
                        
                    </div><!-- div-main -->
                    
                </div><!-- div-box-aba -->                
                
                <div class="div-box-aba" id="bx2"></div><!-- div-box-aba -->
                
                <div class="div-box-aba" id="bx3"></div><!-- div-box-aba -->
                
            </div><!-- div-conteudo -->
        
        </div><!-- conteudo -->
        
<?php
	include('rodape.php');
?>