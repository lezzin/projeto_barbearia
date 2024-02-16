<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body class="only__form">
    <?php include_once "templates/header.php"; ?>

    <main>
        <section>
            <div class="container container__centered vh-100">
                <h2 data-aos="zoom-in" data-aos-duration="1000">Registro</h2>

                <form method="post" action="<?= BASE_URL . "user/create" ?>">
                    <div class="form__alert"></div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1000">
                        <label for="username">Nome</label>
                        <input type="text" id="username" name="username" placeholder="Leandro" required>
                    </div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1000">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="joao@email.com" required>
                    </div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1000">
                        <label for="tel">Telefone</label>
                        <input type="tel" id="tel" name="tel" placeholder="(35) 99999-9999">
                    </div>

                    <div class="form__group" data-aos="fade-right" data-aos-duration="1300">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="********" required>
                    </div>

                    <button class="btn__primary" type="submit" data-aos="fade-right" data-aos-duration="1600">Registrar</button>
                    <a href="<?= BASE_URL . "login" ?>" data-aos="fade-right" data-aos-duration="1900">Já tenho conta</a>
                </form>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/register.js" ?>"></script>
</body>

</html>