<header class="main__header">
    <div class="container">
        <a href="<?= BASE_URL ?>" data-aos="fade-in" data-aos-duration="1000">
            <img class="navbar_brand" src="<?= BASE_URL . "app/public/logo.jpg" ?>" alt="Logo da página" width="40">
        </a>

        <nav data-aos="fade-down" data-aos-duration="1000">
            <a href="<?= BASE_URL ?>">Home</a>
            
            <?php if (isset($isAuth) and $isAuth): ?>
                
                <?php if ($isAdm): ?>
                    <a href="<?= BASE_URL . "admin"  ?>">Admin</a>
                <?php endif; ?>

                <?php if (!$isAdm): ?>
                    <a href="<?= BASE_URL . "profile" ?>">Perfil</i></a>
                <?php endif; ?>

                <a href="<?= BASE_URL . "logout"  ?>">Sair</i></a>

                <?php if (!$isAdm): ?>
                    <a class="btn__primary" role="button" href="<?= BASE_URL . "schedule" ?>">Agendar agora</a>
                <?php endif; ?>

            <?php else: ?>
                <a href="<?= BASE_URL . "login"  ?>">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
