<main id="admin-page">
    <section class="admin-item-section">
        <div class="container">
            <form method="post" action="<?= BASE_URL . "service/save" ?>" id="form-service" class="delay-medium">
                <h2>Serviços</h2>

                <input type="text" name="id" id="service_id" hidden>

                <div class="form-alert"></div>

                <div class="form-group interval-medium">
                    <label for="service_name">Nome</label>
                    <input type="text" id="service_name" name="name" placeholder="Cabelo, barba, pintura..." required>
                </div>

                <div class="form-group interval-medium">
                    <label for="service_price">Preço</label>
                    <input type="text" id="service_price" name="price" placeholder="0.00" required>
                </div>

                <button class="btn-primary interval-medium" type="submit" title="Adicionar serviço">Adicionar serviço</button>
            </form>

            <div class="table-container delay-medium">
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

    <section class="admin-item-section">
        <div class="container">
            <form method="post" action="<?= BASE_URL . "unavailable_datetime/save" ?>" id="form-unavailable-datetime" class="delay-medium">
                <h2>Datas indisponiveis</h2>

                <input type="text" id="unavailable_datetime_id" name="id" hidden>

                <div class="form-alert"></div>

                <div class="form-group interval-medium">
                    <label for="unavailable_datetime_date">Data</label>
                    <input type="date" id="unavailable_datetime_date" name="date" required>
                </div>

                <div class="form-group interval-medium">
                    <label for="unavailable_datetime_time">Data</label>
                    <input type="time" id="unavailable_datetime_time" name="time" required>
                </div>

                <button class="btn-primary interval-medium" type="submit" title="Adicionar data">Adicionar data</button>
            </form>

            <div class="table-container delay-medium">
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

    <section class="admin-item-section">
        <div class="container">
            <form method="post" action="<?= BASE_URL . "contact/save" ?>" id="form-contact-info" class="delay-medium">
                <h2>Informações de contato</h2>

                <input type="text" id="contact_info_id" name="id" hidden>

                <div class="form-alert"></div>

                <div class="form-group interval-medium">
                    <label for="contact_info_email">Email</label>
                    <input type="email" id="contact_info_email" name="email" placeholder="email@email.com" required>
                </div>

                <div class="form-group interval-medium">
                    <label for="contact_info_address">Endereço</label>
                    <input type="text" id="contact_info_address" name="address" placeholder="Rua Centro, 123" required>
                </div>

                <div class="form-group interval-medium">
                    <label for="contact_info_tel">Telefone</label>
                    <input type="tel" id="contact_info_tel" name="tel" placeholder="(12) 12345-1234" required>
                </div>

                <div class="form-group interval-medium">
                    <label for="contact_info_whatsapp">Whatsapp</label>
                    <input type="tel" id="contact_info_whatsapp" name="whatsapp" placeholder="(12) 12345-1234" required>
                </div>

                <button class="btn-primary interval-medium" type="submit" title="Adicionar contato">Adicionar contato</button>
            </form>

            <div class="table-container delay-medium">
                <h3>Contato</h3>

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

    <section class="admin-item-section admin-item-section-rows">
        <div class="container">
            <div class="table-container delay-medium">
                <h3>Agendamentos</h3>
                
                <table>
                    <thead>
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