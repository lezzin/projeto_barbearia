<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body class="only__form">
    <?php include_once "templates/header.php"; ?>

    <main>
        <section>
            <div class="container container__centered vh-100">
                <form method="post" action="<?= BASE_URL . "verify" ?>"class="delay-small card__form">
                    <h2 class="delay-small">Login</h2>

                    <div class="form__alert"></div>

                    <div class="form__group interval-medium">
                        <label for="username">Usuário</label>
                        <input type="text" id="username" name="username" placeholder="Leandro">
                    </div>

                    <div class="form__group interval-medium">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="********">
                    </div>

                    <button class="btn__primary interval-medium" type="submit">Entrar</button>
                    <a href="<?= BASE_URL . "register" ?>" class="interval-medium link__secondary">Não possuo conta</a>
                </form>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/login.js" ?>"></script>
</body>

</html>