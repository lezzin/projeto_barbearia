<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>
    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="hero__section home__section">
            <div class="container">
                <div class="hero__section__info">
                    <h1 data-aos="fade-right" data-aos-duration="1000">Barbershop</h1>
                    <p data-aos="fade-right" data-aos-duration="1300" class="phrase">Construindo confiança, um corte de cada vez...</p>

                    <?php if (!$isAdm): ?>
                        <div data-aos="fade-right" data-aos-duration="1600">
                            <a class="btn__primary" href="<?= BASE_URL . "schedule" ?>" role="button">Agendar horário</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="hero__section__images">
                    <img data-aos="fade-left" data-aos-duration="1000" src="<?= BASE_URL . "app/public/images/hero_image_1.png" ?>" alt="Logo da página" width="300" loading="lazy">
                    <img data-aos="fade-left" data-aos-duration="1300" src="<?= BASE_URL . "app/public/images/hero_image_2.png" ?>" alt="Logo da página" width="300" loading="lazy">
                </div>
            </div>
        </section>

        <section class="about__section">
            <div class="container">
                <img data-aos="fade-right" data-aos-duration="1000" src="<?= BASE_URL . "app/public/images/about_wallpaper.png" ?>" alt="Logo da página" width="500" loading="lazy">

                <div class="about__text">
                    <h2 data-aos="zoom-in" data-aos-duration="1000"><span class="text__detail">Sobre</span> <span class="text__detail__inverse">nós</span></h2>
                    <p data-aos="fade-left" data-aos-duration="1000">
                        Bem-vindo à Barbershop, onde oferecemos uma experiência excepcional de estilo masculino. 
                        Nossa equipe experiente combina técnicas tradicionais com as últimas tendências em cortes de cabelo e barba. 
                        Priorizamos não apenas a transformação da aparência, mas também a elevação da autoestima de nossos clientes. 
                    </p>
                    <p data-aos="fade-left" data-aos-duration="1000">
                        Em um ambiente acolhedor e descontraído, oferecemos serviços de alta qualidade para homens que buscam confiança e estilo. 
                        Seja qual for seu estilo, estamos aqui para ajudar você a encontrar seu melhor visual, um corte de cada vez.
                    </p>

                    <nav class="social__media">
                        <a href="#">
                            <img data-aos="fade-in" data-aos-duration="1000" src="<?= BASE_URL . "app/public/images/instagram-symbol.svg" ?>" alt="instagram logo" width="32">
                        </a>
                    </nav>
                </div>
            </div>
        </section>

        <section class="rates__section">
            <div class="container">
                <h2 data-aos="zoom-in" data-aos-duration="1000"><span class="text__detail">Nossos</span> <span class="text__detail__inverse">Serviços</span></h2>
                <p data-aos="zoom-in" data-aos-duration="1100">Abaixo, uma lista de nossos serviços prestados. Todos focados na melhor qualidade, com os melhores equipamentos.</p>
                    
                <div class="rates__container">
                <?php foreach ($services as $service) : ?>
                    <div class="service" data-aos="fade-right" data-aos-duration="1000">
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
                <h2 data-aos="zoom-in" data-aos-duration="1000"><span class="text__detail__inverse">Galeria</span> <span class="text__detail">de imagens</span></h2>

                <div class="images__container">
                    <div class="images">
                        <img src="<?= BASE_URL . "app/public/images/gallery_1.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1000" loading="lazy">
                        <img src="<?= BASE_URL . "app/public/images/gallery_2.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1200" loading="lazy">
                        <img src="<?= BASE_URL . "app/public/images/gallery_3.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1300" loading="lazy">
                    </div>
                    
                    <div class="images">
                        <img src="<?= BASE_URL . "app/public/images/gallery_4.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1000" loading="lazy">
                        <img src="<?= BASE_URL . "app/public/images/gallery_5.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1200" loading="lazy">
                        <img src="<?= BASE_URL . "app/public/images/gallery_6.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1300" loading="lazy">
                    </div>
                    
                    <div class="images">
                        <img src="<?= BASE_URL . "app/public/images/gallery_7.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1000" loading="lazy">
                        <img src="<?= BASE_URL . "app/public/images/gallery_8.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1200" loading="lazy">
                        <img src="<?= BASE_URL . "app/public/images/gallery_9.jpg" ?>" alt="Gallery image" data-aos="fade-in" data-aos-duration="1300" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <button class="btn__float" data-aos="fade-up" data-aos-duration="1000">
        <img src="<?= BASE_URL . "app/public/images/whatsapp-symbol.svg" ?>" alt="Whatsapp logo" width="56">
    </button>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/home.js" ?>"></script>
</body>

</html>