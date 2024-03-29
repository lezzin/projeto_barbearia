<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "templates/head.php"; ?>

<body class="profile__page">
    <?php include_once "templates/header.php"; ?>

    <main>
        <section class="profile__section">
            <div class="container">
                <h2 class="delay-small"><?= $userData["name"] ?> (<?= $userData["email"] ?> - <?= $userData["tel"] ?>)</h2>

                <div class="card">
                    <h3 class="delay-medium">Seus agendamentos</h3>

                    <div class="table__container">
                        <table class="delay-medium">
                            <thead>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Preço</th>
                                    <th>Data</th>
                                    <th>Mensagem</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody data-schedules-card></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php"; ?>

    <script src="<?= BASE_URL . "app/public/js/profile.js" ?>"></script>
</body>
</html>