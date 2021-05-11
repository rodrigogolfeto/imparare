<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	
    $metaTitle = 'Libri Pubblicati | '.$config['titleBase'];
    $metaDescription = (($tot_blog > 0) ? $lin_blog['text_resumo'] : cutHTML(strip_tags($quemsomos_texto),170));
	$metaUrl = $urlSite;
	$metaImage = $config['urlSite'] . 'images/share.png';
	
    $libriM = true;
	include('includes/topo.inc.php');

    $sql = "SELECT text_texto,(SELECT tag3_imagens.imag_arquivo FROM tag3_imagens WHERE tag3_imagens.imag_text_id = text_id) AS imagem FROM tag3_textos WHERE text_menu_id = '14' AND text_subm_id = '15' LIMIT 1";
    $res = $conn->consulta($sql);
    $lin = $conn->busca($res);

?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>admin/arquivos/imagem/<?=$lin['imagem'];?>) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-yellow py-5">
			<div class="container">
				<h1 class="font-24">Libri Pubblicati</h1>
			</div>
		</div>

		<div class="libri-pubblicati pt-5 pb-3">
			<div class="container pt-5 pb-3"> 
				
                <div class="texto pb-5"><?=$lin['text_texto'];?></div>

                <?php
                
                $sql = "SELECT text_id,text_resumo,text_texto,text_link,(SELECT tag3_imagens.imag_arquivo FROM tag3_imagens WHERE tag3_imagens.imag_text_id = tag3_textos.text_id) AS imagem FROM tag3_textos WHERE text_menu_id = '14' AND text_subm_id = '16' AND text_status = '1' ORDER BY text_ordem ASC";
                $res = $conn->consulta($sql);
                while($lin=$conn->busca($res)){
                    $imagem = $config['urlSite'] . 'admin/arquivos/imagem/' . $lin['imagem'];
                    ?>
                    <div class="item d-flex align-items-end flex-column flex-md-row">
                        <a href="<?=((!empty($lin['text_link'])) ? $lin['text_link'] : '');?>" class="foto" target="_blank"><div style="background: url(<?=$imagem;?>) no-repeat center bottom;"></div></a>
                        <div class="descricao pt-4 pt-md-0">
                            <h2 class="font-14 color-blue"><?=nl2br($lin['text_resumo']);?></h2>
                            <div class="font-14 texto"><?=$lin['text_texto'];?></div>
                        </div>
                    </div>
                    <?php
                }

                /*
                <div class="item d-flex align-items-end">
                    <a href="" class="foto"><div style="background: url(<?=$config['urlSite']?>images/imagem3.jpg) no-repeat center bottom;"></div></a>
                    <div class="descricao">
                        <h2 class="font-14 color-blue">“Português do Brasil<br />– corso per italiani”</h2>
                        <div class="font-14 texto">Il primo libro è stato “Português do Brasil – corso per italiani”, livello A1-B1 del Quadro Comune Europeo di Riferimento per le Lingue. Il libro si struttura in 19 capitoli. Ognuno presenta un testo iniziale attraverso il quale grammatica e lessico relativi con numerosi esercizi di diversa tipologia. Ogni capitolo riporta, inoltre, degli aspetti del linguaggio vivo con le sue espressioni idiomatiche. Compreso nel volume ci sono due CD audio e le risposte degli esercizi possono essere scaricate sul sito dell’editore nella pagina dedicata al libro.</div>
                    </div>
                </div>

                <div class="item d-flex align-items-end">
                    <a href="" class="foto"><div style="background: url(<?=$config['urlSite']?>images/imagem4.jpg) no-repeat center bottom;"></div></a>
                    <div class="descricao">
                        <h2 class="font-14 color-blue">“L’Eserciziario di Português do Brasil”</h2>
                        <div class="font-14 texto">L’Eserciziario di Português do Brasil (livello A1-B1 del Quadro Comune Europeo di Riferimento per le Lingue) ha 17 capitoli e oltre a proporre svariati esercizi di grammatica presenta un ampio lessico che permette allo studente di sviluppare le capacità di comunicare in determinate situazioni o luoghi, come chiedere informazioni, comprare un capo d’abbligliamento in un negozio, instaurare un dialogo in un ristorante, ecc… È utilizzabile in abbinamento a “Português do Brasil – corso per italiani” o a qualsiasi corso di lingua portoghese.</div>
                    </div>
                </div>

                <div class="item d-flex align-items-end">
                    <a href="" class="foto"><div style="background: url(<?=$config['urlSite']?>images/imagem5.jpg) no-repeat center bottom;"></div></a>
                    <div class="descricao">
                        <h2 class="font-14 color-blue">“Tire de Letra!”</h2>
                        <div class="font-14 texto">Tire de Letra! (livello A1 del Quadro Comune Europeo di Riferimento per le Lingue è una guida per principianti assoluti della lingua portoghese e fa parte di una collana di libri, livello A1, della Hoepli Editore. In volume si articola in 52 brevi lezioni in cui sono spiegate in modo molto semplice le regole fondamentali della grammatica di base. È adatto anche allo studio come autodidatta. Tutti i dialoghi in audio sono disponibili per il download nella pagina dedicata della Hoepli.</div>
                    </div>
                </div>
                */

                ?>
                
			</div>
		</div>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 d-flex justify-content-end py-4 py-md-0">
                        <a href="il-corsi" class="links-uteis" style="background: url(<?=$config['urlSite']?>images/i-corsi.jpg) no-repeat center bottom;background-size: cover;">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="rounded-pill py-2 px-5 font-24 line-height-130"><b>I Corsi</b></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-start py-4 py-md-0">
                        <a href="traduzioni-e-interpretariato" class="links-uteis" style="background: url(<?=$config['urlSite']?>images/traduzioni.jpg) no-repeat center bottom;background-size: cover;">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="rounded-pill py-2 px-5 font-24 line-height-130"><b>Traduzioni e interpretariato</b></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php	
			$detalheAtive = true;
			$darken = true; 	
			include('./includes/il-portoghese.inc.php');
		?>

	</main>
		
<?php
	include('includes/rodape.inc.php');	
?>