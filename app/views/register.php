<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>
    <?php include_once "templates/header.php"; ?>

    <main>
        <section>
            <div class="container container__centered vh-100">
                <h2 data-aos="zoom-in" data-aos-duration="1000">Registro</h2>

                <form method="post" action="<?= BASE_URL . "user/create" ?>">
                    <div class="form__alert"></div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1000">
                        <label for="username">Usuário</label>
                        <input type="text" id="username" name="username">
                    </div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1000">
                        <label for="tel">Telefone</label>
                        <input type="tel" id="tel" name="tel">
                    </div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1300">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password">
                    </div>

                    <button class="btn__primary" type="submit" data-aos="fade-right" data-aos-duration="1600">Registrar</button>
                    <a href="<?= BASE_URL . "login" ?>" data-aos="fade-right" data-aos-duration="1900">LJá tenho conta</a>
                </form>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/register.js" ?>"></script>
</body>

</html>