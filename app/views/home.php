<main id="home-page">
    <section class="hero-section home-section">
        <div class="container">
            <div class="hero-section-info">
                <h1 class="delay-small">Barbershop</h1>
                <p class="phrase delay-medium">Elevando seu estilo e sua autoconfiança a novos patamares!</p>

                <?php if (!$isAdm) : ?>
                    <div class="interval-small">
                        <a class="btn-primary" href="<?= BASE_URL . "schedule" ?>" role="button">Agendar horário</a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="hero-section-images">
                <img class="interval-medium" src="<?= BASE_URL . "public/images/hero_image_1.png" ?>" alt="Um homem cortando seu cabelo" width="280">
                <img class="interval-medium" src="<?= BASE_URL . "public/images/hero_image_2.png" ?>" alt="Um homem cortando seu cabelo" width="280">
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <img class="delay-small" src="<?= BASE_URL . "public/images/about_wallpaper.png" ?>" alt="Dois homens cortando seus cabelos" width="500" loading="lazy">

            <div class="about-text">
                <h2 class="delay-small text-detail">Sobre nós</h2>
                <p class="interval-medium">
                    Bem-vindo à Barbershop, onde oferecemos uma experiência excepcional de estilo masculino.
                    Nossa equipe experiente combina técnicas tradicionais com as últimas tendências em cortes de cabelo e barba.
                    Priorizamos não apenas a transformação da aparência, mas também a elevação da autoestima de nossos clientes.
                </p>
                <p class="interval-medium">
                    Em um ambiente acolhedor e descontraído, oferecemos serviços de alta qualidade para homens que buscam confiança e estilo.
                    Seja qual for seu estilo, estamos aqui para ajudar você a encontrar seu melhor visual, um corte de cada vez.
                </p>

                <nav class="social interval-medium">
                    <a href="https://instagram.com" target="_blank" rel="noreferrer noopener"><i class="bi bi-instagram"></i></a>
                    <a href="https://twitter.com" target="_blank" rel="noreferrer noopener"><i class="bi bi-twitter"></i></a>
                </nav>
            </div>
        </div>
    </section>

    <section class="rates-section">
        <div class="container">
            <h2 class="delay-small text-detail--secondary">Nossos serviços</h2>
            <p class="delay-medium">Abaixo, uma lista de nossos serviços prestados. Todos focados na melhor qualidade, com os melhores equipamentos.</p>

            <div class="rates-container">
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

    <section class="gallery-section">
        <div class="container">
            <h2 class="delay-small text-detail">Galeria de imagens</h2>

            <div class="swiper interval-small">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_1.jpg" ?>" alt="Gallery image">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_2.jpg" ?>" alt="Gallery image">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_3.jpg" ?>" alt="Gallery image">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_4.jpg" ?>" alt="Gallery image">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_5.jpg" ?>" alt="Gallery image">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_6.jpg" ?>" alt="Gallery image">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_7.jpg" ?>" alt="Gallery image">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_8.jpg" ?>" alt="Gallery image">
                    </div>
                    <div class="swiper-slide">
                        <img src="<?= BASE_URL . "public/images/gallery_9.jpg" ?>" alt="Gallery image">
                    </div>
                </div>
                
                <div class="swiper-pagination"></div>
            </div>


        </div>
    </section>

    <section class="localization-section">
        <div class="container">
            <h2 class="delay-small text-detail--secondary">Nossa localização</h2>

            <iframe
                width="100%" 
                height="600" 
                frameborder="0" 
                scrolling="no" 
                marginheight="0" 
                marginwidth="0" 
                style="border:0"
                src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Muzambinho,%20State%20of%20Minas%20Gerais,%20Brazil,%2037890-000+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                <a href="https://www.gps.ie/">gps tracker sport</a>
            </iframe>
        </div>
    </section>
</main>

<button class="btn-float" title="Acessar Whatsapp">
    <img class="delay-small" src="<?= BASE_URL . "public/images/whatsapp-symbol.svg" ?>" alt="Whatsapp logo" width="56">
</button>