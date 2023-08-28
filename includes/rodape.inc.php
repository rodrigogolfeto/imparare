		<footer class="rodape">

		    <div class="carousel-rodape">
		        <div>

		            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

		                <div class="carousel-indicators mb-3">
		                    <?php
                            $item = 0;
                            $res_imagens_rodape = $conn->consulta($sql_imagens_rodape);
                            while ($configuracoes_imagens_rodape = $conn->busca($res_imagens_rodape)) {
								?><button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $item; ?>" <?= (($item == 0) ? 'class="active" aria-current="true"' : '') ?> aria-label="<?= $configuracoes_imagens_rodape['text_titulo']; ?>"></button><?php
								$item++;
                            }
                            ?>
		                </div>

		                <div class="carousel-inner">
		                    <?php
                            $item = 0;
                            $res_imagens_rodape = $conn->consulta($sql_imagens_rodape);
                            while ($configuracoes_imagens_rodape = $conn->busca($res_imagens_rodape)) {
								?><div class="carousel-item<?= (($item == 0) ? ' active' : ''); ?>" style="background: url(<?= $config['urlSite'] ?>admin/arquivos/imagem/<?= $configuracoes_imagens_rodape['imag_arquivo']; ?>) no-repeat center bottom;background-size: cover;"></div><?php
								$item++;
                            }
                            ?>
		                </div>

		            </div>

		        </div>
		    </div>

		    <div class="rodape-baixo bg-green py-5">
		        <div class="container py-4">
		            <div class="row justify-content-center">

		                <div class="d-flex flex-column informacoes-container col-12 col-md-5 text-white px-4 px-lg-0 me-0 me-lg-5 pb-5 pb-lg-0">

		                    <div class="flex-grow-1">
		                        <h3>Contatti</h3>
		                        <div class="texto font-14 pb-4">
		                            <?= $configuracoes_texto_contato; ?>
		                        </div>
		                    </div>

		                    <div class="d-flex redes-sociais align-items-center">
		                        <?php if (!empty($configuracoes_social_media_facebook)) { ?><a href="<?= $configuracoes_social_media_facebook; ?>" class="facebook" target="_blank">Facebook</a><?php } ?>
		                        <?php if (!empty($configuracoes_social_media_instagram)) { ?><a href="<?= $configuracoes_social_media_instagram; ?>" class="instagram" target="_blank">Instagram</a><?php } ?>
		                        <?php if (!empty($configuracoes_social_media_youtube)) { ?><a href="<?= $configuracoes_social_media_youtube; ?>" class="youtube" target="_blank">Youtube</a><?php } ?>
		                        <span class="ms-1 fst-italic"><?= $configuracoes_social_media_label; ?></span>
		                    </div>

		                </div>

		                <div class="formulario-contato-container col-12 col-lg-5 px-4 px-lg-0 ms-0 ms-lg-5 mb-3">
		                    <form id="form-contact" onsubmit="sendContact(event,this.id,this);">

		                        <div id="contact-callack"></div>

		                        <input type="hidden" id="hash" name="hash" value="<?= md5(session_id()); ?>" />
                                <input type="hidden" id="action" name="action" value="enviar-contato" />

		                        <div class="pb-1">
		                            <label class="d-block text-white fst-italic font-16 pb-1">Argomento</label>
		                            <input type="text" id="input_argomento" name="argomento" class="font-14" />
		                        </div>
		                        <div class="pb-1">
		                            <label class="d-block text-white fst-italic font-16 pb-1">Nome</label>
		                            <input type="text" id="input_nome" name="nome" class="font-14" />
		                        </div>
		                        <div class="pb-1">
		                            <label class="d-block text-white fst-italic font-16 pb-1">Email</label>
		                            <input type="text" id="input_email" name="email" class="font-14" />
		                        </div>
		                        <div class="pb-1">
		                            <label class="d-block text-white fst-italic font-16 pb-1">Messaggio</label>
		                            <textarea type="text" id="input_messaggio" name="messaggio" class="font-14"></textarea>
		                        </div>
		                        <div class="button-container d-flex justify-content-end pt-2 flex-column flex-md-row">
		                            <button type="submit" class="rounded-pill mx-4 mx-md-0 mt-2 mt-md-0">Enviar</button>
		                        </div>
		                    </form>
		                </div>

		            </div>
		        </div>
		    </div>

		</footer><!-- rodape -->

		</div><!-- tudo -->


		<script type="text/javascript" src="<?= $config['urlSite'] ?>scripts/plugins.min.js"></script>
		<script type="text/javascript" src="<?= $config['urlSite'] ?>scripts/scripts.js?time=<?=$config['cacheFiles'];?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

		</body>

		</html>