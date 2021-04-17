		
        <footer class="rodape">
            
            <div class="carousel-rodape">
                <div>

                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    
                    <div class="carousel-indicators mb-3">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="background: url(<?=$config['urlSite']?>images/topo-pagina-home.jpg) no-repeat center bottom;background-size: cover;"></div>
                        <div class="carousel-item" style="background: url(<?=$config['urlSite']?>images/topo-pagina-home.jpg) no-repeat center bottom;background-size: cover;"></div>
                        <div class="carousel-item" style="background: url(<?=$config['urlSite']?>images/topo-pagina-home.jpg) no-repeat center bottom;background-size: cover;"></div>
                    </div>
                    
                </div>

                </div>
            </div>

            <div class="bg-green py-5">
                <div class="container py-4">
                    <div class="row justify-content-md-center">
                        
                        <div class="d-flex flex-column informacoes-container col-5 text-white p-0 me-5">
                            
                            <div class="flex-grow-1">
                                <h3>Contatti</h3>
                                <div class="texto font-14">
                                    <p>
                                    Per fissare la lezione di prova o richiedere
                                    un preventivo per traduzione:
                                    info@imparareilportoghese.it
                                    </p>

                                    <p>
                                        <a href="">+39 339 896 5505</a>
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex redes-sociais align-items-center">
                                <a href="" class="facebook" target="_blank">Facebook</a>
                                <a href="" class="instagram" target="_blank">Instagram</a>
                                <a href="" class="youtube" target="_blank">Youtube</a>
                                <span class="ms-1 fst-italic">imparareilportoghese</span>
                            </div>

                        </div>
                        
                        <div class="formulario-contato-container col-5 p-0 ms-5 mb-3">
                            <form action="" method="">
                                <div class="pb-1">
                                    <label class="d-block text-white fst-italic font-16 pb-1">Argomento</label>
                                    <input type="text" id="" name="" class="font-14" />
                                </div>
                                <div class="pb-1">
                                    <label class="d-block text-white fst-italic font-16 pb-1">Nome</label>
                                    <input type="text" id="" name="" class="font-14" />
                                </div>
                                <div class="pb-1">
                                    <label class="d-block text-white fst-italic font-16 pb-1">Email</label>
                                    <input type="text" id="" name="" class="font-14" />
                                </div>
                                <div class="pb-1">
                                    <label class="d-block text-white fst-italic font-16 pb-1">Messaggio</label>
                                    <textarea type="text" id="" name="" class="font-14"></textarea>
                                </div>
                                <div class="button-container d-flex justify-content-end pt-2">
                                    <button type="submit" class="rounded-pill">Enviar</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>

        </footer><!-- rodape -->       
        
    </div><!-- tudo --> 
    
    
    <script type="text/javascript" src="<?=$config['urlSite']?>scripts/plugins.min.js"></script>
    <script type="text/javascript" src="<?=$config['urlSite']?>scripts/scripts.js<?=(!empty($config['cacheFiles']))? '?cacheFile=' . $config['cacheFiles']:'';?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>