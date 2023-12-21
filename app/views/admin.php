<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body>

    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="admin__item__section">
            <div class="container">
                <form method="post" action="<?= BASE_URL . "service/create" ?>" id="form-service" data-aos="fade-right" data-aos-duration="1000">
                    <h2>Serviços</h2>

                    <div class="form__alert"></div>

                    <div class="form__group">
                        <label for="service_name">Nome</label>
                        <input type="text" id="service_name" name="name">
                    </div>

                    <div class="form__group">
                        <label for="service_price">Preço</label>
                        <input type="text" id="service_price" name="price">
                    </div>

                    <button class="btn-primary" type="submit">Adicionar serviço</button>
                </form>

                <table data-aos="fade-left" data-aos-duration="1000">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $service) : ?>
                            <tr>
                                <td><?= $service["name"] ?></td>
                                <td><?= $service["price"] ?></td>
                                <td>
                                    <div class="actions">
                                        <button><i class="bi bi-pencil"></i></button>
                                        <button data-delete-url="<?= BASE_URL . "service/delete/{$service["id"]}" ?>" type="button"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin__item__section">
            <div class="container">
                <form method="post" action="<?= BASE_URL . "unavailable_datetime/create" ?>" id="form-unavailable-datetime" data-aos="fade-right" data-aos-duration="1000">
                    <h2>Datas indisponiveis</h2>

                    <div class="form__alert"></div>

                    <div class="form__group">
                        <label for="unavailable_datetime_datetime">Data</label>
                        <input type="datetime-local" id="unavailable_datetime_datetime" name="datetime">
                    </div>

                    <button class="btn-primary" type="submit">Adicionar data</button>
                </form>

                <table data-aos="fade-left" data-aos-duration="1000">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($unavailable_datetimes as $unavailable_datetime) : ?>
                            <tr>
                                <td><?= date_format(date_create($unavailable_datetime["datetime"]), "d/m/Y h:i:s") ?></td>
                                <td>
                                    <div class="actions">
                                        <button><i class="bi bi-pencil"></i></button>
                                        <button data-delete-url="<?= BASE_URL . "unavailable_datetime/delete/{$unavailable_datetime["id"]}" ?>"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/admin.js" ?>"></script>
</body>

</html>