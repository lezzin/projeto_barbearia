<footer> 
    <span id="url" style="display: none;"><?= BASE_URL ?></span>

    <div class="container" data-aos="fade-in" data-aos-duration="1000"> 
        <section class="contact__container">
            <h2>Contato</h2>

            <div class="contact__elements">
                <p><i class="bi bi-envelope"></i> <?= $contact_info["email"] ?></p>
                <p><i class="bi bi-geo-alt"></i> <?= $contact_info["address"] ?></p>
                <p><i class="bi bi-telephone"></i> <?= $contact_info["tel"] ?></p>
                <p><i class="bi bi-whatsapp"></i> <?= $contact_info["whatsapp"] ?></p>
            </div>
        </section>

        <span class="divider"></span>

        <p class="creator">&copy 2024 Leandro Adrian da Silva. Todos os direitos reservados. </p>
    </div>
</footer>

<script>
    AOS.init();
</script>