<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body class="only__form">
    <?php include_once "templates/header.php"; ?>

    <main>
        <section>
            <div class="container container__centered vh-100">
                <h2 data-aos="zoom-in" data-aos-duration="1000">Login</h2>

                <form method="post" action="<?= BASE_URL . "verify" ?>">
                    <div class="form__alert"></div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1000">
                        <label for="username">Usuário</label>
                        <input type="text" id="username" name="username" placeholder="Leandro">
                    </div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1300">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="********">
                    </div>

                    <button class="btn__primary" type="submit" data-aos="fade-right" data-aos-duration="1600">Entrar</button>
                    <a href="<?= BASE_URL . "register" ?>" data-aos="fade-right" data-aos-duration="1900">Não possuo conta</a>
                </form>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/login.js" ?>"></script>
</body>

</html>