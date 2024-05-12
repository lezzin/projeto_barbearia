<main id="schedule-page">
    <section class="hero-section schedule-section">
        <div class="container">
            <div class="hero-section-info delay-small">
                <h1 class="delay-small">Agendamento</h1>
                <p class="delay-medium">
                    Em apenas <span>três passos simples</span>, você estará a caminho do corte perfeito.<br>
                    Escolha seu <span>serviço</span>, agende <span>data e horário</span>, insira <span>seus dados</span> e esteja pronto para se destacar!
                </p>
                <button class="btn-primary start-btn" title="Iniciar agendamento">Agendar agora</button>
            </div>
        </div>
    </section>

    <section class="service-type-section">
        <div class="container container-centered">
            <article>
                <h3 class="delay-small">1. Serviço: Selecione o tipo de serviço</h3>

                <div class="services-container">
                    <?php foreach ($services as $service) : ?>
                        <button class="service interval-small" data-id="<?= $service["id"] ?>" data-service="<?= $service["name"] ?>" title="Selecionar serviço">
                            <h3><?= $service["name"] ?></h3>
                            <p>R$<?= str_replace('.', ',', $service["price"]) ?></p>
                        </button>
                    <?php endforeach ?>
                </div>
            </article>
        </div>
    </section>

    <section class="datetime-section">
        <div class="container">
            <article class="article-columns">
                <div class="column">
                    <h3 class="delay-small">2.1. Data: Selecione a data</h3>

                    <div class="calendar">
                        <div class="calendar-header interval-small">
                            <div>
                                <button class="btn-primary btn-primary--dark btn-sm switch-left" title="Mês anterior"> <i class="bi bi-caret-left"></i></button>
                                <button class="btn-primary btn-primary--dark btn-sm switch-right" title="Próximo mês"> <i class="bi bi-caret-right"></i></button>
                            </div>

                            <h4 class="current-month-year"></h4>
                        </div>

                        <div class="calendar-body interval-small">
                            <div class="calendar-weekdays"></div>
                            <div class="calendar-content"></div>
                        </div>
                    </div>
                </div>

                <div class="column time-column">
                    <h3 class="delay-small">2.2. Horário: Selecione o horário</h3>
                    <div class="time-buttons-container interval-small">
                        <div class="time-buttons">Selecione a data para exibir os horários</div>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <section class="message-section">
        <div class="container">
            <article>
                <form>
                    <h3 class="delay-small">3. Dados: Insira suas informações pessoais</h3>

                    <div class="form-group interval-small">
                        <label for="username_message">Nome </label>
                        <input type="text" id="username_message" placeholder="José da Silva" value="<?= $userData["name"] ?? "" ?>">
                    </div>
                    
                    <div class="form-group interval-small">
                        <label for="email_message">Email</label>
                        <input type="text" id="email_message" placeholder="email@email.com" value="<?= $userData["email"] ?? "" ?>">
                    </div>

                    <div class="form-group interval-small">
                        <label for="telephone_message">Telefone para contato </label>
                        <input type="tel" id="telephone_message" placeholder="35 99999-9999" value="<?= $userData["tel"] ?? "" ?>">
                    </div>

                    <div class="form-group interval-small">
                        <label for="textarea_message">Escreva alguma mensagem para o barbeiro (opcional) </label>
                        <textarea id="textarea_message" rows="5" placeholder="Digite aqui a mensagem"></textarea>
                    </div>

                    <input type="hidden" id="user_id" value="<?= $userData["id"] ?? "" ?>">

                    <button class="btn-primary btn-primary--dark schedule-confirm interval-small" type="button" title="Concluir agendamento">Concluir agendamento</button>
                </form>
            </article>
        </div>
    </section>
</main>

<aside class="modal-overlay">
    <div class="modal">
        <div class="modal-body"></div>

        <div class="modal-footer">
            <button class="btn-primary" id="confirm_modal_btn" title="Confirmar agendamento">Confirmar</button>
            <button class="btn-close" id="modal_close" title="Fechar modal">Fechar</a>
        </div>
    </div>
</aside>

<aside class="notification-overlay"></aside>