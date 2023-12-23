<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>

    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="hero__section bg-down">
            <div class="container">
                <div class="hero__section__info">
                    <h1 data-aos="fade-right" data-aos-duration="1000">Barber Shop</h1>
                    <p data-aos="fade-right" data-aos-duration="1300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores dicta ab assumenda molestiae illo veniam, blanditiis laborum? Quibusdam, esse nam laboriosam harum, quae molestiae obcaecati expedita veritatis officia iure impedit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt rerum corporis harum eius sed? Harum ex accusamus, necessitatibus reprehenderit quo sint exercitationem asperiores autem enim ipsam architecto voluptas rem? Natus!</p>

                    <?php if (!$isAdm): ?>
                        <div data-aos="fade-right" data-aos-duration="1600">
                            <a class="btn__primary" href="<?= BASE_URL . "schedule" ?>" role="button">Agendar horário</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="services__section">
            <div class="container">
                <h2 data-aos="zoom-in" data-aos-duration="1000">Serviços</h2>

                <div class="services__container">
                    <?php foreach ($services as $service) : ?>
                        <div class="service" data-aos="fade-right" data-aos-duration="1000">
                            <h3><?= $service["name"] ?></h3>
                            <p>R$<?= str_replace('.', ',', $service["price"]) ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>

        <section class="informations__section bg-up">
            <div class="container">
                <h2 data-aos="zoom-in" data-aos-duration="1000">Contato</h2>

                <div class="contact__container">
                    <p data-aos="fade-left" data-aos-duration="1300">
                        <i class="bi bi-envelope"></i> <?= $contact_info["email"] ?>
                    </p>
                    <p data-aos="fade-left" data-aos-duration="1600">
                        <i class="bi bi-geo-alt"></i> <?= $contact_info["address"] ?>
                    </p>
                    <p data-aos="fade-left" data-aos-duration="1900">
                        <i class="bi bi-telephone"></i> <?= $contact_info["tel"] ?>
                    </p>
                    <p data-aos="fade-left" data-aos-duration="2200">
                        <i class="bi bi-whatsapp"></i> <?= $contact_info["whatsapp"] ?>
                    </p>
                </div>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

</body>

</html>