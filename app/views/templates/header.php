<header class="main-header <?= isset($class) ? 'secondary' : '' ?>">
    <div class="container">
        <a href="<?= config('app.base_url') ?>" title="Acessar página inicial">
            <img class="navbar_brand" src="<?= config('app.base_url') . "public/logo.jpg" ?>" alt="Logo da página" width="40">
        </a>

        <nav>
            <a href="<?= config('app.base_url') ?>" title="Acessar página inicial">Início</a>

            <?php if (isset($isAuth) and $isAuth) : ?>

                <?php if ($isAdm) : ?>
                    <a href="<?= config('app.base_url') . "admin" ?>" title="Acessar administração">Administração</a>
                <?php endif; ?>

                <?php if (!$isAdm) : ?>
                    <a href="<?= config('app.base_url') . "profile" ?>" title="Acessar agendamentos">Agendamentos</i></a>
                <?php endif; ?>

                <a href="<?= config('app.base_url') . "logout" ?>" title="Sair da conta">Sair</i></a>

            <?php else : ?>
                <a href="<?= config('app.base_url') . "login" ?>" title="Acessar conta">Fazer login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>