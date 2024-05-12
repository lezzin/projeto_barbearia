<header class="main-header">
    <div class="container">
        <a href="<?= BASE_URL ?>" title="Acessar página inicial">
            <img class="navbar_brand" src="<?= BASE_URL . "app/public/logo.jpg" ?>" alt="Logo da página" width="40">
        </a>

        <nav>
            <a href="<?= BASE_URL ?>" title="Acessar página inicial">Início</a>

            <?php if (isset($isAuth) and $isAuth) : ?>

                <?php if ($isAdm) : ?>
                    <a href="<?= BASE_URL . "admin" ?>" title="Acessar administração">Admin</a>
                <?php endif; ?>

                <?php if (!$isAdm) : ?>
                    <a href="<?= BASE_URL . "profile" ?>" title="Acessar perfil">Perfil</i></a>
                <?php endif; ?>

                <a href="<?= BASE_URL . "logout" ?>" title="Sair da conta">Sair</i></a>
                
            <?php else : ?>
                <a href="<?= BASE_URL . "login" ?>" title="Acessar conta">Fazer login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<div class="loader">
    <img src="<?= BASE_URL . "app/public/logo.jpg" ?>" alt="Logo da página" width="40" height="40">
</div>