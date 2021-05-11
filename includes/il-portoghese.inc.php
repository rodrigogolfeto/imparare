<div class="<?=(isset($detalheAtive) ? 'cmdetalhe ' : '')?>bg-blue py-5<?=(isset($darken) ? ' darken' : '')?>">
    <div class="container py-4">
        <h4 class="titulo text-white pb-3">Il Portoghese</h4>
        <?php

        $sql = "SELECT text_texto FROM tag3_textos WHERE text_menu_id = '6' LIMIT 1";
        // $sql = "SELECT text_texto,text_texto2,imag_arquivo FROM tag3_textos,tag3_imagens WHERE tag3_textos.text_id = tag3_imagens.imag_text_id AND text_menu_id = '6' LIMIT 1";
        $res = $conn->consulta($sql);
        $lin = $conn->busca($res);

        ?>
        <div class="texto font-16 text-white"><?=$lin['text_texto'];?></div>
        <div class="d-flex justify-content-end pt-2 px-3">
            <a href="il-portoghese" class="bg-yellow btn-mais">+</a> 
        </div>
    </div>
</div>