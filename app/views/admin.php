<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>

    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="admin__item__section">
            <div class="container">
                <form method="post" action="<?= BASE_URL . "service/save" ?>" id="form-service" data-aos="fade-right" data-aos-duration="1000">
                    <h2>Serviços</h2>
                    
                    <input type="text" name="id" id="service_id" hidden>

                    <div class="form__alert"></div>

                    <div class="form__group">
                        <label for="service_name">Nome</label>
                        <input type="text" id="service_name" name="name">
                    </div>

                    <div class="form__group">
                        <label for="service_price">Preço</label>
                        <input type="text" id="service_price" name="price">
                    </div>


                    <button class="btn__primary" type="submit">Adicionar serviço</button>
                </form>

                <table data-aos="fade-left" data-aos-duration="1000">
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
        </section>

        <section class="admin__item__section">
            <div class="container">
                <form method="post" action="<?= BASE_URL . "unavailable_datetime/save" ?>" id="form-unavailable-datetime" data-aos="fade-right" data-aos-duration="1000">
                    <h2>Datas indisponiveis</h2>
                
                    <input type="text" id="unavailable_datetime_id" name="id" hidden>

                    <div class="form__alert"></div>

                    <div class="form__group">
                        <label for="unavailable_datetime_datetime">Data</label>
                        <input type="date" id="unavailable_datetime_date" name="date">
                    </div>

                    <div class="form__group">
                        <label for="unavailable_datetime_datetime">Data</label>
                        <input type="time" id="unavailable_datetime_time" name="time">
                    </div>
                    
                    <button class="btn__primary" type="submit">Adicionar data</button>
                </form>

                <table data-aos="fade-left" data-aos-duration="1000">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody data-table-unavailable-datetime></tbody>
                </table>
            </div>
        </section>

        <section class="admin__item__section">
            <div class="container">
                <table data-aos="fade-left" data-aos-duration="1000">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Telefone</th>
                            <th>Serviço</th>
                            <th>Data</th>
                            <th>Mensagem</th>
                        </tr>
                    </thead>
                    <tbody data-table-schedules></tbody>
                </table>
            </div>
        <section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/admin.js" ?>"></script>
</body>

</html>