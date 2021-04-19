<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title><?php echo $titPag; ?></title>
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

    <base href="<?php echo $config['urlSite']; ?>" />
    <link rel="stylesheet" href="<?=$config['urlSite']?>css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=$config['urlSite']?>css/main.css<?= (!empty($config['cacheFiles'])) ? '?cacheFile=' . $config['cacheFiles'] : ''; ?>" type="text/css" media="screen" />
</head>

<body>
 
    <div id="root">

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