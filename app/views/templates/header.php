<header class="main__header">
    <div class="container">
        <a href="<?= BASE_URL ?>" data-aos="fade-in" data-aos-duration="1000">
            <img class="navbar_brand" src="<?= BASE_URL . "app/public/logo.jpg" ?>" alt="Logo da página" width="40">
        </a>

        <nav data-aos="fade-down" data-aos-duration="1000">
            <a href="<?= BASE_URL ?>">Home</a>
            <?php if (isset($isAuth) and $isAuth): ?>
                <a href="<?= BASE_URL . "admin"  ?>">Admin</a>
            <?php else: ?>
                    <a class="btn-primary" role="button" href="<?= BASE_URL . "schedule" ?>">Agende já seu horário!</a>
            <?php endif; ?>
        </nav>
    </div>
</header>