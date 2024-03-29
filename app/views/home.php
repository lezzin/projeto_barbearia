<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>
    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="hero__section home__section">
            <div class="container">
                <div class="hero__section__info">
                    <h1 class="delay-small">Barbershop</h1>
                    <p class="phrase delay-medium">Construindo confiança, um corte de cada vez...</p>

                    <?php if (!$isAdm) : ?>
                        <div class="interval-small">
                            <a class="btn__primary" href="<?= BASE_URL . "schedule" ?>" role="button">Agendar horário</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="hero__section__images">
                    <img class="interval-medium" src="<?= BASE_URL . "app/public/images/hero_image_1.png" ?>" alt="Um homem cortando seu cabelo" width="280">
                    <img class="interval-medium" src="<?= BASE_URL . "app/public/images/hero_image_2.png" ?>" alt="Um homem cortando seu cabelo" width="280">
                </div>
            </div>
        </section>

        <section class="about__section">
            <div class="container">
                <img class="delay-small" src="<?= BASE_URL . "app/public/images/about_wallpaper.png" ?>" alt="Dois homens cortando seus cabelos" width="500" loading="lazy">

                <div class="about__text">
                    <h2 class="delay-small text__detail">Sobre nós</h2>
                    <p class="interval-medium">
                        Bem-vindo à Barbershop, onde oferecemos uma experiência excepcional de estilo masculino.
                        Nossa equipe experiente combina técnicas tradicionais com as últimas tendências em cortes de cabelo e barba.
                        Priorizamos não apenas a transformação da aparência, mas também a elevação da autoestima de nossos clientes.
                    </p>
                    <p class="interval-medium">
                        Em um ambiente acolhedor e descontraído, oferecemos serviços de alta qualidade para homens que buscam confiança e estilo.
                        Seja qual for seu estilo, estamos aqui para ajudar você a encontrar seu melhor visual, um corte de cada vez.
                    </p>
                </div>
            </div>
        </section>

        <section class="rates__section">
            <div class="container">
                <h2 class="delay-small text__detail--secondary">Nossos serviços</h2>
                <p class="delay-medium">Abaixo, uma lista de nossos serviços prestados. Todos focados na melhor qualidade, com os melhores equipamentos.</p>

                <div class="rates__container">
                    <?php foreach ($services as $service) : ?>
                        <div class="service interval-medium">
                            <h3><?= $service["name"] ?></h3>
                            <span class="divider"></span>
                            <p>R$<?= str_replace('.', ',', $service["price"]) ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>

        <section class="gallery__section">
            <div class="container">
                <h2 class="delay-small text__detail">Galeria de imagens</h2>

                <div class="images__container">
                    <div class="images">
                        <img src="<?= BASE_URL . "app/public/images/gallery_1.jpg" ?>" alt="Gallery image" class="interval-medium">
                        <img src="<?= BASE_URL . "app/public/images/gallery_2.jpg" ?>" alt="Gallery image" class="interval-medium">
                        <img src="<?= BASE_URL . "app/public/images/gallery_3.jpg" ?>" alt="Gallery image" class="interval-medium">
                    </div>

                    <div class="images">
                        <img src="<?= BASE_URL . "app/public/images/gallery_4.jpg" ?>" alt="Gallery image" class="interval-medium">
                        <img src="<?= BASE_URL . "app/public/images/gallery_5.jpg" ?>" alt="Gallery image" class="interval-medium">
                        <img src="<?= BASE_URL . "app/public/images/gallery_6.jpg" ?>" alt="Gallery image" class="interval-medium">
                    </div>

                    <div class="images">
                        <img src="<?= BASE_URL . "app/public/images/gallery_7.jpg" ?>" alt="Gallery image" class="interval-medium">
                        <img src="<?= BASE_URL . "app/public/images/gallery_8.jpg" ?>" alt="Gallery image" class="interval-medium">
                        <img src="<?= BASE_URL . "app/public/images/gallery_9.jpg" ?>" alt="Gallery image" class="interval-medium">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <button class="btn__float">
        <img class="delay-small" src="<?= BASE_URL . "app/public/images/whatsapp-symbol.svg" ?>" alt="Whatsapp logo" width="56">
    </button>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/home.js" ?>"></script>
</body>

</html>