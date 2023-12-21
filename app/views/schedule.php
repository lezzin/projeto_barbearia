<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>

    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="hero__section schedule__hero__section bg-down">
            <div class="container">
                <div class="hero__section__info">
                    <h1 data-aos="fade-right" data-aos-duration="1000">Agendamento</h1>
                    <p data-aos="fade-right" data-aos-duration="1300">
                        Em apenas 3 simples passos, você conseguirá rapidamente o seu agendamento.
                        Selecione o tipo de serviço, a data e o horário e pronto, está concluido!
                    </p>

                    <button class="btn-primary start__btn" data-aos="fade-right" data-aos-duration="1600">Começar agora</button>
                </div>
            </div>
        </section>

        <section class="service__type__section">
            <div class="container">
                <h2 class="title__background service__title__background">tipo de serviço</h2>

                <article>
                    <h3 data-aos="zoom-in" data-aos-duration="1000">1. Selecione o tipo de serviço</h3>

                    <div class="services__container services__sm">
                        <?php foreach ($services as $service) : ?>
                            <div class="service" data-aos="fade-right" data-aos-duration="1000" data-id="<?= $service["id"] ?>">
                                <h3><?= $service["name"] ?></h3>
                                <p>R$<?= str_replace('.', ',', $service["price"]) ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                </article>
            </div>
        </section>

        <section class="datetime__section bg-up">
            <div class="container">
                <h2 class="title__background datetime__title__background">Data e hora</h2>

                <article class="article__columns">
                    <div class="column">
                        <h3 data-aos="zoom-in" data-aos-duration="1000">2. Selecione a data</h3>

                        <div class="calendar">
                            <div class="calendar_header">
                                <div>
                                    <button class="btn-primary btn-sm switch-left" data-aos="fade-left" data-aos-duration="1000"> <i class="bi bi-caret-left"></i></button>
                                    <button class="btn-primary btn-sm switch-right" data-aos="fade-left" data-aos-duration="1300"> <i class="bi bi-caret-right"></i></button>
                                </div>

                                <h4 class="current-month-year" data-aos="fade-right" data-aos-duration="1600"></h4>
                            </div>

                            <div class="calendar_weekdays" data-aos="fade-right" data-aos-duration="1900"></div>
                            <div class="calendar_content" data-aos="fade-right" data-aos-duration="1900"></div>
                        </div>
                    </div>

                    <div class="column">
                        <h3 data-aos="zoom-in" data-aos-duration="1000">3. Selecione o horário</h3>
                        <div class="time__buttons"></div>
                    </div>
                </article>
            </div>
        </section>

        <section class="message__section">
            <div class="container">
                <article>
                    <h3 data-aos="zoom-in" data-aos-duration="1000">4. Insira suas informações pessoais</h3>

                    <form>
                        <div class="form__group" data-aos="fade-left" data-aos-duration="1300">
                            <label for="username">Nome </label>
                            <input type="text" id="username_message" placeholder="José da Silva">
                        </div>

                        <div class="form__group" data-aos="fade-left" data-aos-duration="1600">
                            <label for="telephone">Telefone para contato </label>
                            <input type="tel" id="telephone_message" placeholder="35 99999-9999">
                        </div>

                        <div class="form__group" data-aos="fade-left" data-aos-duration="1900">
                            <label for="textarea_message">Escreva alguma mensagem para o barbeiro (opcional) </label>
                            <textarea id="textarea_message" rows="5" placeholder="Digite aqui a mensagem"></textarea>
                        </div>
                    </form>

                    <button class="btn-primary schedule__confirm" data-aos="fade-up" data-aos-duration="1000">Confirmar agendamento</button>
                </article>
            </div>
        </section>
    </main>

    <aside class="modal__overlay">
        <div class="modal">
            <div class="modal__body"></div>

            <div class="modal__footer">
                <button class="btn-primary" id="confirm_modal_btn">Confirmar</button>
                <button class="btn-close" id="modal_close">Cancelar</a>
            </div>
        </div>
    </aside>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/schedules.js" ?>"></script>
</body>

</html>