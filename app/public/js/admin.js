$(document).ready(function () {    
    const url =  $("span#url").text();
    
    function formatDate(dateToFormat) {
        const datetime =  new Date(dateToFormat);
        const date = datetime.toLocaleDateString();
        const time = datetime.toLocaleTimeString();
        
        return `${date} ${time}`;
    }

    function formatToPrice(number) {
        const price = String(number).replace(".", ",");
        return `R$${price}`;
    }

    async function getServices() {
        const data = await fetch(`${url}service/get_all`);
        const services = await data.json();
        $("[data-table-services]").empty();
        
        services.forEach(service => {
            $("[data-table-services]").append(`
                <tr>
                    <td data-name>${service.name}</td>
                    <td data-price>${formatToPrice(service.price)}</td>
                    <td>
                        <div class="actions">
                            <button data-edit-table="service" data-id="${service.id}"><i class="bi bi-pencil"></i></button>
                            <button data-delete-url="${url}service/delete/${service.id}"" type="button"><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `);
        })
    }

    async function getContact() {
        const data = await fetch(`${url}contact/get_all`);
        const contact = await data.json();
        $("[data-table-contact]").empty();

        $("[data-table-contact]").append(`
            <tr>
                <td data-email>${contact.email}</td>
                <td data-address>${contact.address}</td>
                <td data-tel>${contact.tel}</td>
                <td data-whatsapp>${contact.whatsapp}</td>
                <td>
                    <div class="actions">
                        <button data-edit-table="contact" data-id="${contact.id}"><i class="bi bi-pencil"></i></button>
                        <button data-delete-url="${url}contact/delete/${contact.id}"" type="button"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
            </tr>
        `);
    }

    async function getUnavailableDatetimes() {
        const data = await fetch(`${url}unavailable_datetime/get_all`);
        const unavailableDatetimes = await data.json();
        $("[data-table-unavailable-datetime]").empty();
        
        unavailableDatetimes.forEach(unavailable_datetime => {
            $("[data-table-unavailable-datetime]").append(`
                <tr>
                    <td data-date="${unavailable_datetime.datetime}">${formatDate(unavailable_datetime.datetime)}</td>
                    <td>
                        <div class="actions">
                            <button data-edit-table="unavailable_datetime" data-id="${unavailable_datetime.id}"><i class="bi bi-pencil"></i></button>
                            <button data-delete-url="${url}unavailable_datetime/delete/${unavailable_datetime.id}"><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `);
        })
    }

    async function getSchedules() {
        const data = await fetch(`${url}schedule/get_all`);
        const schedules = await data.json();
        $("[data-table-schedules]").empty();
        
        schedules.forEach(schedule => {
            $("[data-table-schedules]").append(`
                <tr>
                    <td>${schedule.user}</td>
                    <td>${schedule.tel}</td>
                    <td>${schedule.service}</td>
                    <td>${formatToPrice(schedule.service_price)}</td>
                    <td>${formatDate(schedule.datetime)}</td>
                    <td>${schedule.message ? schedule.message : "---"}</td>
                </tr>
            `);
        })
    }

    $('#form-contact-info').submit(function(e) {
        e.preventDefault();
    
        const formData = $(this).serialize();
        const action = $(this).attr('action');
        const alert = $(this).children(".form__alert");
    
        $.post(action, formData)
            .done(data => {
                const response = JSON.parse(data);
                alert.empty();
                
                if(response.success) {
                    alert.append(`<div class="success"><p>${response.success}</p></div>`);
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }

                $(this).trigger("reset");
            getContact();
            })
    });

    $('#form-service').submit(function(e) {
        e.preventDefault();
    
        const formData = $(this).serialize();
        const action = $(this).attr('action');
        const alert = $(this).children(".form__alert");
    
        $.post(action, formData)
            .done(data => {
                const response = JSON.parse(data);
                alert.empty();
                
                if(response.success) {
                    alert.append(`<div class="success"><p>${response.success}</p></div>`);
                    getServices();
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }

                $(this).trigger("reset");
            })
    });

    $('#form-unavailable-datetime').submit(function(e) {
        e.preventDefault();
    
        const formData = $(this).serialize();
        const action = $(this).attr('action');
        const alert = $(this).children(".form__alert");

        $.post(action, formData)
            .done(data => {
                const response = JSON.parse(data);
                alert.empty();
                
                if(response.success) {
                    alert.append(`<div class="success"><p>${response.success}</p></div> `);
                    getUnavailableDatetimes();
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }

                $(this).trigger("reset");
            })
    });


    $('.admin__item__section').on('click', '[data-delete-url]', function() {
        const action = $(this).attr('data-delete-url');
        const alert = $(this).parents(".container").children("form").children(".form__alert");
    
        $.post(action)
            .done(data => {
                const response = JSON.parse(data);
                alert.empty();
    
                if(response.success) {
                    alert.append(`<div class="success"><p>${response.success}</p></div>`);
                    getServices();
                    getUnavailableDatetimes();
                    getContact();
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }
                
            });
    });

    $('.admin__item__section').on('click', '[data-edit-table]', function() {
        const table = $(this).attr('data-edit-table');
        const id = $(this).attr('data-id');

        switch (table) {
            case 'service':
                const tdName = $(this).parents(".actions").parents("td").siblings("td[data-name]").text();
                const tdPrice = $(this).parents(".actions").parents("td").siblings("td[data-price]").text();
                
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

    getServices();
    getUnavailableDatetimes();
    getContact();
    getSchedules();
});
