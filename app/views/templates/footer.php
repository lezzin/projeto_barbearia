<footer>
    <span id="url" style="display: none;"><?= BASE_URL ?></span>

    <div class="container">
        <?php if ($contact_info) : ?>
            <section class="contact__container">
                <h2>Contato</h2>

                <div class="contact__elements">
                    <?php if (isset($contact_info["email"])) : ?> <p><i class="bi bi-envelope"></i> <?= $contact_info["email"] ?></p> <?php endif; ?>
                    <?php if (isset($contact_info["address"])) : ?> <p><i class="bi bi-geo-alt"></i> <?= $contact_info["address"] ?></p> <?php endif; ?>
                    <?php if (isset($contact_info["tel"])) : ?> <p><i class="bi bi-telephone"></i> <?= $contact_info["tel"] ?></p> <?php endif; ?>
                    <?php if (isset($contact_info["whatsapp"])) : ?> <p><i class="bi bi-whatsapp"></i> <?= $contact_info["whatsapp"] ?></p> <?php endif; ?>
                </div>
            </section>
            <span class="divider"></span>
        <?php endif ?>

        <p class="creator">&copy 2024 Leandro Adrian da Silva. Todos os direitos reservados. </p>
    </div>
</footer>