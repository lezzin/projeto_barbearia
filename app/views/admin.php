<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body class="admin__page">
    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="admin__item__section">
            <div class="container">
                <form method="post" action="<?= BASE_URL . "service/save" ?>" id="form-service" class="delay-medium">
                    <h2>Serviços</h2>

                    <input type="text" name="id" id="service_id" hidden>

                    <div class="form__alert"></div>

                    <div class="form__group interval-medium">
                        <label for="service_name">Nome</label>
                        <input type="text" id="service_name" name="name" placeholder="Cabelo, barba, pintura..." required>
                    </div>

                    <div class="form__group interval-medium">
                        <label for="service_price">Preço</label>
                        <input type="text" id="service_price" name="price" placeholder="0.00" required>
                    </div>

                    <button class="btn__primary interval-medium" type="submit">Adicionar serviço</button>
                </form>

                <div class="table__container delay-medium">
                    <h3>Serviços</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody data-table-services></tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="admin__item__section">
            <div class="container">
                <form method="post" action="<?= BASE_URL . "unavailable_datetime/save" ?>" id="form-unavailable-datetime" class="delay-medium">
                    <h2>Datas indisponiveis</h2>

                    <input type="text" id="unavailable_datetime_id" name="id" hidden>

                    <div class="form__alert"></div>

                    <div class="form__group interval-medium">
                        <label for="unavailable_datetime_date">Data</label>
                        <input type="date" id="unavailable_datetime_date" name="date" required>
                    </div>

                    <div class="form__group interval-medium">
                        <label for="unavailable_datetime_time">Data</label>
                        <input type="time" id="unavailable_datetime_time" name="time" required>
                    </div>

                    <button class="btn__primary interval-medium" type="submit">Adicionar data</button>
                </form>

                <div class="table__container delay-medium">
                    <h3>Datas indisponiveis</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody data-table-unavailable-datetime></tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="admin__item__section">
            <div class="container">
                <form method="post" action="<?= BASE_URL . "contact/save" ?>" id="form-contact-info" class="delay-medium">
                    <h2>Informaçoes de contato</h2>

                    <input type="text" id="contact_info_id" name="id" hidden>

                    <div class="form__alert"></div>

                    <div class="form__group interval-medium">
                        <label for="contact_info_email">Email</label>
                        <input type="email" id="contact_info_email" name="email" placeholder="email@email.com" required>
                    </div>

                    <div class="form__group interval-medium">
                        <label for="contact_info_address">Endereço</label>
                        <input type="text" id="contact_info_address" name="address" placeholder="Rua Centro, 123" required>
                    </div>

                    <div class="form__group interval-medium">
                        <label for="contact_info_tel">Telefone</label>
                        <input type="tel" id="contact_info_tel" name="tel" placeholder="(12) 12345-1234" required>
                    </div>

                    <div class="form__group interval-medium">
                        <label for="contact_info_whatsapp">Whatsapp</label>
                        <input type="tel" id="contact_info_whatsapp" name="whatsapp" placeholder="(12) 12345-1234" required>
                    </div>

                    <button class="btn__primary interval-medium" type="submit">Adicionar contato</button>
                </form>

                <div class="table__container delay-medium">
                    <h2>Contato</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Endereço</th>
                                <th>Telefone</th>
                                <th>Whatsapp</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody data-table-contact></tbody>
                    </table>
                </div>
            </div>
            <section>

                <section class="admin__item__section admin__item__section__rows">
                    <div class="container">
                        <div class="table__container delay-medium">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="8">Agendamentos</th>
                                    </tr>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Telefone</th>
                                        <th>Email</th>
                                        <th>Serviço</th>
                                        <th>Preço</th>
                                        <th>Data</th>
                                        <th>Mensagem</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody data-table-schedules></tbody>
                            </table>
                        </div>
                    </div>
                    <section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/admin.js" ?>"></script>
</body>

</html>