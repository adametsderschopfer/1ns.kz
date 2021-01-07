<!DOCTYPE html>
<html lang='ru'>

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154462416-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-154462416-1');
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>1ns.kz - Сайт г. Нур-Султан</title>

    <link href="/css/style.css" rel="stylesheet" />


    <script src="/js/ckeditor/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/js/jquery.scrollbox.min.js"></script>
</head>

<body>
    <div id='main'>
        <div id='header'>
            <a href="/">
                <div class='logo'><img src="/img_f/logo.png" width="200" border="0" /></div>
            </a>

            <div class='ad'>
                <?php
                $db->query("SELECT * FROM ads WHERE cat_id = 2 && id >= RAND() * (SELECT MAX(id) FROM ads WHERE cat_id = 2)");
                $ads = $db->FetchArray();

                ?>
                <a href="<?= $ads['url']; ?>" target='_blank' class='s720110'><img src="<?= $ads['img']; ?>"></a>
            </div>
        </div>


        <div class="main_menu">
            <ul>
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>
                    <a href="/news/">Новости</a>
                </li>
                <li>
                    <a href="/companyes/">Компании</a>
                </li>
                <li>
                    <a href="/dir/">Справочник</a>
                </li>
                <li>
                    <a href="/city/">Город</a>
                </li>
                <li>
                    <a href="/announce/">Объявления</a>
                </li>
                <li>
                    <a href="/forum/">Форум</a>
                </li>
            </ul>
        </div>

        <div id='content'>