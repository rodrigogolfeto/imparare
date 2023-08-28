<?php
    $config                     = array();    
    $config['titleBase']        = 'Imparare';
    $config['urlSite']          = (($_SERVER['HTTP_HOST'] == 'localhost') ? 'http://localhost/imparare/' : (($_SERVER['HTTP_HOST'] == 'imparare.localhost') ? 'http://imparare.localhost/' : 'http://' . $_SERVER['HTTP_HOST'] . '/novo/'));
    $config['descriptionSite']  = "";
    $config['keywordsSite']     = "";
    $config['cacheFiles']       = "v3";
?>