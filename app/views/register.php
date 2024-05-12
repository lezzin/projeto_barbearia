<main id="register-page">
    <section>
        <div class="container container-centered delay-small">
            <form method="post" action="<?= BASE_URL . "user/create" ?>" class="delay-small card-form register-form">
                <h2 class="delay-small">Registro</h2>

                <div class="form-alert"></div>

                <div class="form-group interval-medium">
                    <label for="username">Nome</label>
                    <input type="text" id="username" name="username" placeholder="Leandro" required>
                </div>

                <div class="form-group interval-medium">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="joao@email.com" required>
                </div>

                <div class="form-group interval-medium">
                    <label for="tel">Telefone</label>
                    <input type="tel" id="tel" name="tel" placeholder="(35) 99999-9999">
                </div>

                <div class="form-group interval-medium">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>

                <button class="btn-primary interval-medium" type="submit" title="Criar conta">Registrar</button>
                <a href="<?= BASE_URL . "login" ?>" class="interval-medium link-secondary" title="Acessar conta">Já tenho conta</a>
            </form>
        </div>
    </section>
</main>