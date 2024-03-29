<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body id="schedule_page">
    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="hero__section schedule__section bg-down">
            <div class="container">
                <div class="hero__section__info delay-small">
                    <h1 class="delay-small">Agendamento</h1>
                    <p class="delay-medium">
                        Em apenas <span>4 simples passos</span>, você conseguirá o seu agendamento.<br>
                        Preencha o <span>tipo de serviço, a data, o horário, seus dados pessoais </span> e pronto, está concluido!
                    </p>

                    <button class="btn__primary start__btn">Começar agora</button>
                </div>
            </div>
        </section>

        <section class="service__type__section">
            <div class="container container__centered">
                <h2 class="title__background service__title__background">tipo de serviço</h2>

                <article>
                    <h3 class="delay-small">1. Selecione o tipo de serviço</h3>

                    <div class="services__container">
                        <?php foreach ($services as $service) : ?>
                            <div class="service interval-medium" data-id="<?= $service["id"] ?>" data-service="<?= $service["name"] ?>">
                                <h3><?= $service["name"] ?></h3>
                                <p>R$<?= str_replace('.', ',', $service["price"]) ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                </article>
            </div>
        </section>

        <section class="datetime__section">
            <div class="container">
                <h2 class="title__background datetime__title__background">Data e hora</h2>

                <article class="article__columns">
                    <div class="column">
                        <h3 class="delay-small">2. Selecione a data</h3>

                        <div class="calendar">
                            <div class="calendar__header">
                                <div>
                                    <button class="btn__primary btn__primary--dark btn__sm switch-left interval-medium"> <i class="bi bi-caret-left"></i></button>
                                    <button class="btn__primary btn__primary--dark btn__sm switch-right interval-medium"> <i class="bi bi-caret-right"></i></button>
                                </div>

                                <h4 class="current-month-year delay-medium"></h4>
                            </div>

                            <div class="calendar__body delay-medium">
                                <div class="calendar__weekdays"></div>
                                <div class="calendar__content"></div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <h3 style="display: none">3. Selecione o horário</h3>
                        <div class="time__buttons__container">
                            <div class="time__buttons"></div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="message__section">
            <div class="container">
                <article>
                    <h3 class="delay-small">4. Insira suas informações pessoais</h3>

                    <form class="delay-medium">
                        <div class="form__group interval-medium" >
                            <label for="username_message">Nome </label>
                            <input type="text" id="username_message" placeholder="José da Silva" value="<?= $userData["name"] ?? "" ?>">
                        </div>
                        
                        <div class="form__group interval-medium">
                            <label for="email_message">Email</label>
                            <input type="text" id="email_message" placeholder="email@email.com" value="<?= $userData["email"] ?? "" ?>">
                        </div>

                        <div class="form__group interval-medium">
                            <label for="telephone_message">Telefone para contato </label>
                            <input type="tel" id="telephone_message" placeholder="35 99999-9999" value="<?= $userData["tel"] ?? "" ?>">
                        </div>

                        <div class="form__group interval-medium">
                            <label for="textarea_message">Escreva alguma mensagem para o barbeiro (opcional) </label>
                            <textarea id="textarea_message" rows="5" placeholder="Digite aqui a mensagem"></textarea>
                        </div>

                        <input type="hidden" id="user_id" value="<?= $userData["id"] ?? "" ?>">

                        <button class="btn__primary btn__primary--dark schedule__confirm delay-small" type="button">Confirmar agendamento</button>
                    </form>
                </article>
            </div>
        </section>
    </main>

    <aside class="modal__overlay">
        <div class="modal">
            <div class="modal__body"></div>

            <div class="modal__footer">
                <button class="btn__primary" id="confirm_modal_btn">Confirmar</button>
                <button class="btn-close" id="modal_close">Cancelar</a>
            </div>
        </div>
    </aside>

    <aside class="notification__overlay"></aside>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/schedules.js" ?>"></script>
</body>

</html>