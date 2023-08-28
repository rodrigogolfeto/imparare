<?php
	include('includes/config.inc.php');
	include('includes/funcoes.inc.php');
	
    $metaTitle = 'Il Corsi | '.$config['titleBase'];
    $metaDescription = (($tot_blog > 0) ? $lin_blog['text_resumo'] : cutHTML(strip_tags($quemsomos_texto),170));
	$metaUrl = $urlSite;
	$metaImage = $config['urlSite'] . 'images/share.png';

	$ilcorsiM = true;
	include('includes/topo.inc.php');

    $sql = "SELECT text_titulo,text_texto,imag_arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '7' AND text_subm_id = '8'";
    $res = $conn->consulta($sql);
    $lin = $conn->busca($res);

?>

	<main class="conteudo">

		<div class="topo-pagina" style="background: url(<?=$config['urlSite']?>admin/arquivos/imagem/<?=$lin['imag_arquivo'];?>) no-repeat center bottom;background-size: cover;"></div>

		<div class="bg-green py-5">
			<div class="container">
				<h1 class="text-white font-24"><?=$lin['text_titulo'];?></h1>
			</div>
		</div>

		<div class="ilcorsi py-5">
			<div class="container py-5"> 
				
                <div class="texto">
					<?=$lin['text_texto'];?>
                </div>

                <div class="form-conteudo pt-5">
                    
                    <button type="button" class="border-0 rounded-pill bg-blue font-24 text-white py-1 px-5 mb-4"><span class="px-5">Scrivimi</span></button>
                    
                    <form id="form-sottoscrizione" onsubmit="sendSottoscrizione(event,this.id,this);">

                        <div id="sottoscrizione-callack"></div>

                        <input type="hidden" id="sottoscrizione_hash" name="hash" value="<?= md5(session_id()); ?>" />
                        <input type="hidden" id="sottoscrizione_hashcode1" name="hash_code1" value="<?=md5('7');?>" />
                        <input type="hidden" id="sottoscrizione_hashcode2" name="hash_code2" value="<?=md5('9');?>" />
                        <input type="hidden" id="sottoscrizione_action" name="action" value="send-sottoscrizione" />

                        <div class="pb-3"><input type="text" id="sottoscrizione_nome" name="nome" placeholder="Nome" class="rounded-pill" /></div>
                        <div class="pb-3"><input type="text" id="sottoscrizione_email" name="email" placeholder="E-mail" class="rounded-pill" /></div>
                        <div class="pb-3"><textarea id="sottoscrizione_messaggio" name="messaggio" placeholder="Messaggio"></textarea></div>
                        <div class="d-flex justify-content-end pt-2">
                            <button type="submit" class="border-0 rounded-pill bg-green font-16 py-1 px-5 text-white"><span class="px-5">Invia</span></button>
                        </div>
                    </form>          
                </div>

			</div>
		</div>

        <?php		
            include('./includes/il-brasile.inc.php');
        ?>

	</main>
		
<?php
	include('includes/rodape.inc.php');	
?>