<div class="cmdetalhe bg-yellow py-5">
    <div class="container pb-4 pt-5">
        <h4 class="titulo pb-3">Il Brasile</h4>

        <?php
        $sql = "SELECT text_resumo,text_texto,text_texto2,tag3_imagens.imag_arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '13' AND text_subm_id = '0'";
        $res = $conn->consulta($sql);
        $lin = $conn->busca($res);
        ?>
        
        <div class="row">
            <div class="col-12 col-md-4 autor color-green-darken font-28 fst-italic d-flex align-items-center justify-content-start justify-content-md-center pb-2 pb-md-0">
                <b>
                    <?=nl2br($lin['text_resumo']);?>
                </b>
            </div>
            <div class="col">
                <?=$lin['text_texto'];?>
            </div>
        </div>
        
        
        <div class="d-flex justify-content-end pt-4 px-3">
            <a href="il-brasile" class="bg-blue btn-mais">+</a>
        </div>
    </div>
</div>