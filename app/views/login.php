<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>
    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="form__section">
            <div class="container">
                <h2>Login</h2>

                <form method="post" action="<?= BASE_URL . "verify" ?>">
                    <div class="form__alert"></div>

                    <div class="form__group">
                        <label for="username">Usuário</label>
                        <input type="text" id="username" name="username">
                    </div>

                    <div class="form__group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password">
                    </div>

                    <button class="btn-primary" type="submit">Entrar</button>
                    <a href="<?php BASE_URL ?>">Sou cliente</a>
                </form>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/login.js" ?>"></script>
</body>

</html>