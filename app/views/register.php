<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body class="only__form">
    <?php include_once "templates/header.php"; ?>

    <main>
        <section>
            <div class="container container__centered vh-100 delay-small">
                <h2 class="delay-small">Registro</h2>

                <form method="post" action="<?= BASE_URL . "user/create" ?>">
                    <div class="form__alert"></div>

                    <div class="form__group interval-medium">
                        <label for="username">Nome</label>
                        <input type="text" id="username" name="username" placeholder="Leandro" required>
                    </div>

                    <div class="form__group interval-medium">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="joao@email.com" required>
                    </div>

                    <div class="form__group interval-medium">
                        <label for="tel">Telefone</label>
                        <input type="tel" id="tel" name="tel" placeholder="(35) 99999-9999">
                    </div>

                    <div class="form__group interval-medium">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="********" required>
                    </div>

                    <button class="btn__primary interval-medium" type="submit">Registrar</button>
                    <a href="<?= BASE_URL . "login" ?>" class="interval-medium">Já tenho conta</a>
                </form>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/register.js" ?>"></script>
</body>

</html>