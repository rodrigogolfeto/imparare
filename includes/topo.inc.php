<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

    <?php include('includes/metas.inc.php'); ?>

    <link rel="apple-touch-icon" sizes="57x57" href="<?=$config['urlSite']?>images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=$config['urlSite']?>images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=$config['urlSite']?>images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$config['urlSite']?>images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=$config['urlSite']?>images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=$config['urlSite']?>images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=$config['urlSite']?>images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=$config['urlSite']?>images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$config['urlSite']?>images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=$config['urlSite']?>images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$config['urlSite']?>images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=$config['urlSite']?>images/favicon/favicon-96x96.png"> 
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$config['urlSite']?>images/favicon/favicon-16x16.png">

    <link rel="canonical" href="<?=$urlSite;?>">

    <base href="<?php echo $config['urlSite']; ?>" />
    <link rel="stylesheet" href="<?=$config['urlSite']?>css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=$config['urlSite']?>css/main.css<?= (!empty($config['cacheFiles'])) ? '?cacheFile=' . $config['cacheFiles'] : ''; ?>" type="text/css" media="screen" />

</head>

<body>

    <input type="hidden" id="baseurl" value="<?=$config['urlSite'];?>">
 
    <div id="root">

        <h1 class="d-none"><?=$metaTitle;?></h1>

        <header class="topo">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href=""><?=$config['titleBase']?></a>
                </div>                
                <nav class="menu">
                    <ul>
                        <li><a href="il-portoghese" class="font-14<?=(isset($ilportogheseM) ? ' active' : '')?>">Il portoghese</a></li>
                        <li><a href="il-corsi" class="font-14<?=(isset($ilcorsiM) ? ' active' : '')?>">I corsi</a></li>
                        <li><a href="traduzioni-e-interpretariato" class="font-14<?=(isset($traduzioniM) ? ' active' : '')?>">Traduzioni e interpretariato</a></li>
                        <li><a href="il-brasile" class="font-14<?=(isset($ilbrasileM) ? ' active' : '')?>">Il Brasile</a></li>
                        <li><a href="libri-pubblicati" class="font-14<?=(isset($libriM) ? ' active' : '')?>">Libri pubblicati</a></li>
                        <li><a href="opinioni" class="font-14<?=(isset($opinioniM) ? ' active' : '')?>">Opinioni</a></li>
                        <li><a href="javascript:goTo('rodape-baixo');" class="font-14">CONTATTI</a></li>
                        <li><a href="blog" class="font-14<?=(isset($blogM) ? ' active' : '')?>">Blog</a></li>
                    </ul>
                </nav>
                <button class="d-block d-xl-none btn-menu primary border-0 font-16 m-3">MENU<div><span></span></div></button>
            </div>
        </header><!-- topo -->

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>