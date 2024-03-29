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

        const $colspanNumber = $table.siblings("thead").children("tr").children("th").length;
        if(data.length <= 0) {
            $table.append(`<td style="text-align: center" colspan="${$colspanNumber}">Nenhum conteúdo cadastrado</td>`)
            return;
        }

        data.forEach(item => {
            $table.append(template(item));
        });
    }

    function getServiceRowTemplate(service) {
        const tr = document.createElement('tr');

        const td1 = document.createElement('td');
        td1.setAttribute('data-name', '');
        td1.textContent = service.name;

        const td2 = document.createElement('td');
        td2.setAttribute('data-price', '');
        td2.textContent = formatToPrice(service.price);

        const td3 = document.createElement('td');
        const div = document.createElement('div');
        div.classList.add('actions');
        const button1 = document.createElement('button');
        button1.setAttribute('data-edit-table', 'service');
        button1.setAttribute('data-id', service.id);
        const icon1 = document.createElement('i');
        icon1.classList.add('bi', 'bi-pencil');
        button1.appendChild(icon1);
        const button2 = document.createElement('button');
        button2.setAttribute('data-delete-url', `${url}service/delete/${service.id}`);
        button2.setAttribute('type', 'button');
        const icon2 = document.createElement('i');
        icon2.classList.add('bi', 'bi-trash');
        button2.appendChild(icon2);
        div.appendChild(button1);
        div.appendChild(button2);
        td3.appendChild(div);

        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);

        return tr;
    }

    function getContactRowTemplate(contact) {
        const tr = document.createElement('tr');

        const td1 = document.createElement('td');
        td1.setAttribute('data-email', '');
        td1.textContent = contact.email;

        const td2 = document.createElement('td');
        td2.setAttribute('data-address', '');
        td2.textContent = contact.address;

        const td3 = document.createElement('td');
        td3.setAttribute('data-tel', '');
        td3.textContent = contact.tel;

        const td4 = document.createElement('td');
        td4.setAttribute('data-whatsapp', '');
        td4.textContent = contact.whatsapp;

        const td5 = document.createElement('td');
        const div = document.createElement('div');
        div.classList.add('actions');
        const button1 = document.createElement('button');
        button1.setAttribute('data-edit-table', 'contact');
        button1.setAttribute('data-id', contact.id);
        const icon1 = document.createElement('i');
        icon1.classList.add('bi', 'bi-pencil');
        button1.appendChild(icon1);
        const button2 = document.createElement('button');
        button2.setAttribute('data-delete-url', `${url}contact/delete/${contact.id}`);
        button2.setAttribute('type', 'button');
        const icon2 = document.createElement('i');
        icon2.classList.add('bi', 'bi-trash');
        button2.appendChild(icon2);
        div.appendChild(button1);
        div.appendChild(button2);
        td5.appendChild(div);

        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        tr.appendChild(td5);

        return tr;
    }

    function getUnavailableDatetimeRowTemplate(unavailableDatetime) {
        const tr = document.createElement('tr');

        const td1 = document.createElement('td');
        td1.setAttribute('data-date', unavailableDatetime.datetime);
        td1.textContent = formatDate(unavailableDatetime.datetime);

        const td2 = document.createElement('td');
        const div = document.createElement('div');
        div.classList.add('actions');
        const button1 = document.createElement('button');
        button1.setAttribute('data-edit-table', 'unavailable_datetime');
        button1.setAttribute('data-id', unavailableDatetime.id);
        const icon1 = document.createElement('i');
        icon1.classList.add('bi', 'bi-pencil');
        button1.appendChild(icon1);
        const button2 = document.createElement('button');
        button2.setAttribute('data-delete-url', `${url}unavailable_datetime/delete/${unavailableDatetime.id}`);
        const icon2 = document.createElement('i');
        icon2.classList.add('bi', 'bi-trash');
        button2.appendChild(icon2);
        div.appendChild(button1);
        div.appendChild(button2);
        td2.appendChild(div);

        tr.appendChild(td1);
        tr.appendChild(td2);

        return tr;
    }

    function getScheduleRowTemplate(schedule) {
        const tr = document.createElement('tr');

        const td1 = document.createElement('td');
        td1.textContent = schedule.user;

        const td2 = document.createElement('td');
        td2.textContent = schedule.tel;

        const td3 = document.createElement('td');
        td3.textContent = schedule.email;

        const td4 = document.createElement('td');
        td4.textContent = schedule.service;

        const td5 = document.createElement('td');
        td5.textContent = formatToPrice(schedule.service_price);

        const td6 = document.createElement('td');
        td6.textContent = formatDate(schedule.datetime);

        const td7 = document.createElement('td');
        td7.textContent = schedule.message ? schedule.message : "---";

        const td8 = document.createElement('td');
        td8.classList.add('status__select');
        const select = document.createElement('select');

        const option1 = document.createElement('option');
        option1.setAttribute('value', '1');
        option1.selected = '1' == schedule.status;
        option1.textContent = 'Pendente';

        const option2 = document.createElement('option');
        option2.setAttribute('value', '2');
        option2.selected = '2' == schedule.status;
        option2.textContent = 'Aceito';

        const option3 = document.createElement('option');
        option3.setAttribute('value', '3');
        option3.selected = '3' == schedule.status;
        option3.textContent = 'Rejeitado';

        select.appendChild(option1);
        select.appendChild(option2);
        select.appendChild(option3);
        select.onchange = function (e) {
            handleUpdateSchedule(schedule.id, e.target.value);
        }

        td8.appendChild(select);

        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        tr.appendChild(td5);
        tr.appendChild(td6);
        tr.appendChild(td7);
        tr.appendChild(td8);

        return tr;
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

    async function handleUpdateSchedule(schedule, status) {
        const action = `${url}schedule/update_status`;

        try {
            const response = await $.post(action, {
                id: schedule,
                status: status
            });

            const jsonResponse = JSON.parse(response);
            if (jsonResponse.error) {
                alert(jsonResponse.error)
            }
        } catch (err) {
            console.error(err);
        }
    }
});
