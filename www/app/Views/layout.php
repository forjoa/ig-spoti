<?php
$session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?=
        $title 
        ?> - LSpoty
    </title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="/home"><?= lang('App.nav.home') ?></a>
            <a href="/my-playlists"><?= lang('App.nav.my_playlists') ?></a>
        </div>
        <div class="navbar-right">
            <form action="/home" method="GET">
                <input type="text" name="query" placeholder="<?= lang('App.search.placeholder') ?>">
                <button type="submit"><?= lang('App.search.button') ?></button>
            </form>
            <a href="/profile"><?= $session->get('user_email') ?></a>
            <a href="/logout"><?= lang('App.nav.logout') ?></a>
        </div>
    </nav>
    <div class="content">
        <?= $content ?>
    </div>
    <script src="/assets/js/scripts.js"></script>
</body>
</html>