<footer>
    <span id="url" style="display: none;"><?= BASE_URL ?></span>

    <div class="container">
        <div class="footer-grid">
            <section class="column">
                <h2>Menu principal</h2>

                <nav>
                    <a href="<?= BASE_URL ?>">Início</a>

                    <?php if (isset($isAuth) and $isAuth) : ?>
                        <?php if ($isAdm) : ?>
                            <a href="<?= BASE_URL . "admin" ?>" title="Acessar administração">Admin</a>
                        <?php endif; ?>

                        <?php if (!$isAdm) : ?>
                            <a href="<?= BASE_URL . "profile" ?>" title="Acessar perfil">Perfil</i></a>
                            <a href="<?= BASE_URL . "schedule" ?>" title="Acessar agendamento">Agendar horário</a>
                        <?php endif; ?>

                        <a href="<?= BASE_URL . "logout"  ?>" title="Sair da conta">Sair</i></a>

                    <?php else : ?>

                        <a href="<?= BASE_URL . "login"  ?>" title="Acessar conta">Fazer login</a>

                    <?php endif; ?>
                </nav>
            </section>
            <?php if ($contact_info) : ?>
                <section class="column">
                    <h2>Contato</h2>

                    <div class="contact-elements">
                        <?php if (isset($contact_info["email"])) : ?> <p><i class="bi bi-envelope"></i> <?= $contact_info["email"] ?></p> <?php endif; ?>
                        <?php if (isset($contact_info["address"])) : ?> <p><i class="bi bi-geo-alt"></i> <?= $contact_info["address"] ?></p> <?php endif; ?>
                        <?php if (isset($contact_info["tel"])) : ?> <p><i class="bi bi-telephone"></i> <?= $contact_info["tel"] ?></p> <?php endif; ?>
                        <?php if (isset($contact_info["whatsapp"])) : ?> <p><i class="bi bi-whatsapp"></i> <?= $contact_info["whatsapp"] ?></p> <?php endif; ?>
                    </div>
                </section>
            <?php endif ?>
        </div>

        <p class="creator">&copy 2024 Leandro Adrian da Silva. Todos os direitos reservados. </p>
    </div>
</footer>
</body>

</html>