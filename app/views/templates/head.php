<!DOCTYPE html>
<html lang="pt-br">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Bem-vindo à Barbershop, onde oferecemos uma experiência excepcional de estilo masculino.">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= config('app.base_url') . "public/css/style.css" ?>">

        <?php if (!empty($css_links)) : foreach ($css_links as $css) : ?>
                        <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach;
        endif; ?>

        <link rel="icon" href="<?= config('app.base_url') . "public/logo.jpg" ?>">

        <script src="<?= config('app.base_url') . "public/js/libs/jquery-3.7.1.min.js" ?>"></script>
        <script src="<?= config('app.base_url') . "public/js/libs/scrollreveal.min.js" ?>"></script>
        <script src="<?= config('app.base_url') . "public/js/libs/smoothscroll.min.js" ?>"></script>
        <script src="<?= config('app.base_url') . "public/js/script.js" ?>" defer></script>

        <?php if (!empty($scripts)) : foreach ($scripts as $script) : ?>
                        <script src="<?= $script ?>" defer></script>
        <?php endforeach;
        endif; ?>

        <title><?= $title . ' - ' .  config('app.title')  ?></title>
</head>

<body>