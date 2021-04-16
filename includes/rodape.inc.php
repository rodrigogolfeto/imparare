		
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
                        <div class="col-5 text-white pe-5">
                            <h3>Contatti</h3>
                            <div class="texto">
                                <p>
                                Per fissare la lezione di prova o richiedere
                                un preventivo per traduzione:
                                info@imparareilportoghese.it
                                </p>

                                <p>+39 339 896 5505</p>
                            </div>
                        </div>
                        <div class="col-5 ps-5">
                            <form action="" method="">
                                <div>
                                    <label class="d-block text-white">Argomento</label>
                                    <input type="text" />
                                </div>
                                <div>
                                    <label class="d-block text-white">Nome</label>
                                    <input type="text" />
                                </div>
                                <div>
                                    <label class="d-block text-white">Email</label>
                                    <input type="text" />
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