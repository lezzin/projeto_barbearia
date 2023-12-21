<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>
    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="form__section">
            <div class="container">
                <h2 data-aos="zoom-in" data-aos-duration="1000">Login</h2>

                <form method="post" action="<?= BASE_URL . "verify" ?>">
                    <div class="form__alert"></div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1000">
                        <label for="username">Usuário</label>
                        <input type="text" id="username" name="username">
                    </div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1300">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password">
                    </div>

                    <button class="btn-primary" type="submit" data-aos="fade-right" data-aos-duration="1600">Entrar</button>
                    <a href="<?php BASE_URL ?>" data-aos="fade-right" data-aos-duration="1900">Sou cliente</a>
                </form>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/login.js" ?>"></script>
</body>

</html>