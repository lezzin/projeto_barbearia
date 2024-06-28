$(function () {
    const url = $("span#url").text();

    function formatDate(dateToFormat) {
        const datetime = new Date(dateToFormat);
        const date = datetime.toLocaleDateString();
        const time = datetime.toLocaleTimeString();
        return `${date} ${time}`;
    }

    function formatToPrice(number) {
        const price = String(number).replace(".", ",");
        return `R$${price}`;
    }

    async function fetchData(endpoint) {
        const data = await fetch(`${url}${endpoint}`);
        return data.json();
    }

    function populateTable($table, data, template) {
        $table.empty();

        const $colspanNumber = $table.siblings("thead").children("tr").children("th").length;
        if (data.length <= 0) {
            $table.append(`<td style="text-align: center" colspan="${$colspanNumber}">Nenhum conteúdo cadastrado</td>`)
            return;
        }

        data.forEach(item => {
            $table.append(template(item));
        });
    }

    function getServiceRowTemplate(service) {
        const $tr = $("<tr>");

        const $td1 = $("<td>").attr('data-name', '').text(service.name);
        const $td2 = $("<td>").attr('data-price', '').text(formatToPrice(service.price));
        const $td3 = $("<td>").append(
            $("<div>").addClass('actions').append(
                $("<button>").attr({ 'data-edit-table': 'service', 'data-id': service.id }).append(
                    $("<i>").addClass('bi bi-pencil')
                ),
                $("<button>").attr({ 'data-delete-url': `${url}service/delete/${service.id}`, 'type': 'button' }).append(
                    $("<i>").addClass('bi bi-trash')
                )
            )
        );

        $tr.append($td1, $td2, $td3);
        return $tr;
    }

    function getContactRowTemplate(contact) {
        const $tr = $("<tr>");

        const $td1 = $("<td>").attr('data-email', '').text(contact.email);
        const $td2 = $("<td>").attr('data-address', '').text(contact.address);
        const $td3 = $("<td>").attr('data-tel', '').text(contact.tel);
        const $td4 = $("<td>").attr('data-whatsapp', '').text(contact.whatsapp);
        const $td5 = $("<td>").append(
            $("<div>").addClass('actions').append(
                $("<button>").attr({ 'data-edit-table': 'contact', 'data-id': contact.id }).append(
                    $("<i>").addClass('bi bi-pencil')
                ),
                $("<button>").attr({ 'data-delete-url': `${url}contact/delete/${contact.id}`, 'type': 'button' }).append(
                    $("<i>").addClass('bi bi-trash')
                )
            )
        );

        $tr.append($td1, $td2, $td3, $td4, $td5);
        return $tr;
    }

    function getUnavailableDatetimeRowTemplate(unavailableDatetime) {
        const $tr = $("<tr>");

        const $td1 = $("<td>").attr('data-date', unavailableDatetime.datetime).text(formatDate(unavailableDatetime.datetime));
        const $td2 = $("<td>").append(
            $("<div>").addClass('actions').append(
                $("<button>").attr({ 'data-edit-table': 'unavailable_datetime', 'data-id': unavailableDatetime.id }).append(
                    $("<i>").addClass('bi bi-pencil')
                ),
                $("<button>").attr({ 'data-delete-url': `${url}unavailable_datetime/delete/${unavailableDatetime.id}`, 'type': 'button' }).append(
                    $("<i>").addClass('bi bi-trash')
                )
            )
        );

        $tr.append($td1, $td2);
        return $tr;
    }

    function getScheduleRowTemplate(schedule) {
        const $tr = $("<tr>");

        const $td1 = $("<td>").text(schedule.user);
        const $td2 = $("<td>").text(schedule.tel);
        const $td3 = $("<td>").text(schedule.email);
        const $td4 = $("<td>").text(schedule.service);
        const $td5 = $("<td>").text(formatToPrice(schedule.service_price));
        const $td6 = $("<td>").text(formatDate(schedule.datetime));
        const $td7 = $("<td>").addClass("user-message").text(schedule.message ? schedule.message : "---");
        const $td8 = $("<td>").addClass('status-select').append(
            $("<select>").on('change', function (e) {
                handleUpdateSchedule(schedule.id, e.target.value);
            }).append(
                $("<option>").attr('value', '1').prop('selected', '1' == schedule.status).text('Pendente'),
                $("<option>").attr('value', '2').prop('selected', '2' == schedule.status).text('Aceito'),
                $("<option>").attr('value', '3').prop('selected', '3' == schedule.status).text('Rejeitado')
            )
        );

        $tr.append($td1, $td2, $td3, $td4, $td5, $td6, $td7, $td8);
        return $tr;
    }


    async function updateTable($table, endpoint, rowTemplate) {
        const data = await fetchData(endpoint);
        populateTable($table, data, rowTemplate);
    }

    $('#form-contact-info, #form-service, #form-unavailable-datetime').submit(async function (e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const action = $(this).attr('action');
        const alert = $(this).children(".form-alert");

        try {
            const response = await $.post(action, formData);
            const jsonResponse = JSON.parse(response);
            alert.empty();

            if (jsonResponse.status == 200) {
                alert.append(`<div class="success"><p>${jsonResponse.message}</p></div>`).fadeIn(200);

                switch ($(this).attr('id')) {
                    case 'form-contact-info':
                        updateTable($("[data-table-contact]"), 'contact/get_all', getContactRowTemplate);
                        break;
                    case 'form-service':
                        updateTable($("[data-table-services]"), 'service/get_all', getServiceRowTemplate);
                        break;
                    case 'form-unavailable-datetime':
                        updateTable($("[data-table-unavailable-datetime]"), 'unavailable_datetime/get_all', getUnavailableDatetimeRowTemplate);
                        break;
                }

                return;
            }

            alert.append(`<div class="error"><p>${jsonResponse.message}</p></div>`).fadeIn(200);
        } catch (error) {
            console.error("Error:", error);
        } finally {
            $(this).trigger("reset");
            setTimeout(() => { alert.fadeOut(200) }, 4000);
        }
    });

    $('.admin-item-section').on('click', '[data-delete-url]', async function () {
        const action = $(this).attr('data-delete-url');
        const alert = $(this).parents(".container").children("form").children(".form-alert");

        try {
            const response = await $.post(action);
            const jsonResponse = JSON.parse(response);
            alert.empty();

            if (jsonResponse.status === 200) {
                alert.append(`<div class="success"><p>${jsonResponse.message}</p></div>`).fadeIn(200);
                updateTable($("[data-table-services]"), 'service/get_all', getServiceRowTemplate);
                updateTable($("[data-table-unavailable-datetime]"), 'unavailable_datetime/get_all', getUnavailableDatetimeRowTemplate);
                updateTable($("[data-table-contact]"), 'contact/get_all', getContactRowTemplate);

                return;
            }

            alert.append(`<div class="error"><p>${jsonResponse.message}</p></div>`).fadeIn(200);
        } catch (error) {
            console.error("Error:", error);
        } finally {
            setTimeout(() => { alert.fadeOut(200); }, 4000);
        }
    });

    $('.admin-item-section').on('click', '[data-edit-table]', function () {
        const table = $(this).attr('data-edit-table');
        const id = $(this).attr('data-id');

        switch (table) {
            case 'service':
                const tdName = $(this).parents(".actions").parents("td").siblings("td[data-name]").text();
                const tdPrice = String($(this).parents(".actions").parents("td").siblings("td[data-price]").text()).replace("R$", "");

                $("#service_name").val(tdName);
                $("#service_price").val(tdPrice);
                $("#service_id").val(id);
                break;

            case 'unavailable_datetime':
                const tdDate = $(this).parents(".actions").parents("td").siblings("td[data-date]").attr("data-date").split(" ");
                const date = tdDate[0];
                const time = tdDate[1];

                $("#unavailable_datetime_date").val(date);
                $("#unavailable_datetime_time").val(time);
                $("#unavailable_datetime_id").val(id);
                break;

            case 'contact':
                const tdEmail = $(this).parents(".actions").parents("td").siblings("td[data-email]").text();
                const tdAddress = $(this).parents(".actions").parents("td").siblings("td[data-address]").text();
                const tdTel = $(this).parents(".actions").parents("td").siblings("td[data-tel]").text();
                const tdWhatsapp = $(this).parents(".actions").parents("td").siblings("td[data-whatsapp]").text();

                $("#contact_info_email").val(tdEmail);
                $("#contact_info_address").val(tdAddress);
                $("#contact_info_tel").val(tdTel);
                $("#contact_info_whatsapp").val(tdWhatsapp);
                $("#contact_info_id").val(id);
                break;

            default:
                break;
        }
    });

    async function handleUpdateSchedule(schedule, status) {
        const action = `${url}schedule/update_status`;

        try {
            const response = await $.post(action, {
                id: schedule,
                status: status
            });

            const jsonResponse = JSON.parse(response);

            if (jsonResponse.status !== 200) {
                alert(jsonResponse.message);
            }
        } catch (err) {
            console.error(err);
        }
    }

    updateTable($("[data-table-services]"), 'service/get_all', getServiceRowTemplate);
    updateTable($("[data-table-unavailable-datetime]"), 'unavailable_datetime/get_all', getUnavailableDatetimeRowTemplate);
    updateTable($("[data-table-contact]"), 'contact/get_all', getContactRowTemplate);
    updateTable($("[data-table-schedules]"), 'schedule/get_all', getScheduleRowTemplate);
});
