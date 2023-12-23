$(document).ready(function () {
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

        data.forEach(item => {
            $table.append(template(item));
        });
    }

    function getServiceRowTemplate(service) {
        return `
            <tr>
                <td data-name>${service.name}</td>
                <td data-price>${formatToPrice(service.price)}</td>
                <td>
                    <div class="actions">
                        <button data-edit-table="service" data-id="${service.id}"><i class="bi bi-pencil"></i></button>
                        <button data-delete-url="${url}service/delete/${service.id}" type="button"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
            </tr>`;
    }

    function getContactRowTemplate(contact) {
        return `
            <tr>
                <td data-email>${contact.email}</td>
                <td data-address>${contact.address}</td>
                <td data-tel>${contact.tel}</td>
                <td data-whatsapp>${contact.whatsapp}</td>
                <td>
                    <div class="actions">
                        <button data-edit-table="contact" data-id="${contact.id}"><i class="bi bi-pencil"></i></button>
                        <button data-delete-url="${url}contact/delete/${contact.id}" type="button"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
            </tr>`;
    }

    function getUnavailableDatetimeRowTemplate(unavailableDatetime) {
        return `
            <tr>
                <td data-date="${unavailableDatetime.datetime}">${formatDate(unavailableDatetime.datetime)}</td>
                <td>
                    <div class="actions">
                        <button data-edit-table="unavailable_datetime" data-id="${unavailableDatetime.id}"><i class="bi bi-pencil"></i></button>
                        <button data-delete-url="${url}unavailable_datetime/delete/${unavailableDatetime.id}"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
            </tr>`;
    }

    function getScheduleRowTemplate(schedule) {
        return `
            <tr>
                <td>${schedule.user}</td>
                <td>${schedule.tel}</td>
                <td>${schedule.service}</td>
                <td>${formatToPrice(schedule.service_price)}</td>
                <td>${formatDate(schedule.datetime)}</td>
                <td>${schedule.message ? schedule.message : "---"}</td>
            </tr>`;
    }

    async function updateTable($table, endpoint, rowTemplate) {
        const data = await fetchData(endpoint);
        populateTable($table, data, rowTemplate);
    }

    $('#form-contact-info, #form-service, #form-unavailable-datetime').submit(async function (e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const action = $(this).attr('action');
        const alert = $(this).children(".form__alert");

        try {
            const response = await $.post(action, formData);
            const jsonResponse = JSON.parse(response);
            alert.empty();

            if (jsonResponse.success) {
                alert.append(`<div class="success"><p>${jsonResponse.success}</p></div>`);

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
            } else {
                alert.append(`<div class="error"><p>${jsonResponse.error}</p></div>`);
            }

            $(this).trigger("reset");
        } catch (error) {
            console.error("Error:", error);
        }
    });

    $('.admin__item__section').on('click', '[data-delete-url]', async function () {
        const action = $(this).attr('data-delete-url');
        const alert = $(this).parents(".container").children("form").children(".form__alert");

        try {
            const response = await $.post(action);
            const jsonResponse = JSON.parse(response);
            alert.empty();

            if (jsonResponse.success) {
                alert.append(`<div class="success"><p>${jsonResponse.success}</p></div>`);
                updateTable($("[data-table-services]"), 'service/get_all', getServiceRowTemplate);
                updateTable($("[data-table-unavailable-datetime]"), 'unavailable_datetime/get_all', getUnavailableDatetimeRowTemplate);
                updateTable($("[data-table-contact]"), 'contact/get_all', getContactRowTemplate);
            } else {
                alert.append(`<div class="error"><p>${jsonResponse.error}</p></div>`);
            }
        } catch (error) {
            console.error("Error:", error);
        }
    });

    $('.admin__item__section').on('click', '[data-edit-table]', function () {
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

    updateTable($("[data-table-services]"), 'service/get_all', getServiceRowTemplate);
    updateTable($("[data-table-unavailable-datetime]"), 'unavailable_datetime/get_all', getUnavailableDatetimeRowTemplate);
    updateTable($("[data-table-contact]"), 'contact/get_all', getContactRowTemplate);
    updateTable($("[data-table-schedules]"), 'schedule/get_all', getScheduleRowTemplate);
});
