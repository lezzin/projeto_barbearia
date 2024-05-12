<main id="profile-page">
    <section class="profile-section">
        <div class="container">
            <h2 class="delay-small"><?= $userData["name"] ?></h2>
            <p class="delay-medium">Email: <?= $userData["email"] ?></p>
            <p class="delay-medium">Telefone: <?= $userData["tel"] ?></p>

            <div class="card delay-small">
                <h3>Seus agendamentos</h3>

                <div class="table-container">
                    <table class="interval-medium">
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