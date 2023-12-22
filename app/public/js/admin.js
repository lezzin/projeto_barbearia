$(document).ready(function () {    
    const url =  $("span#url").text();

    async function getServices() {
        const data = await fetch(`${url}service/get_all`);
        const services = await data.json();
        $("[data-table-services]").empty();
        
        services.forEach(service => {
            $("[data-table-services]").append(`
                <tr>
                    <td data-name>${service.name}</td>
                    <td data-price>${service.price}</td>
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

    async function getUnavailableDatetimes() {
        const data = await fetch(`${url}unavailable_datetime/get_all`);
        const unavailableDatetimes = await data.json();
        $("[data-table-unavailable-datetime]").empty();
        
        unavailableDatetimes.forEach(unavailable_datetime => {
            $("[data-table-unavailable-datetime]").append(`
                <tr>
                    <td data-date="${unavailable_datetime.datetime}">${unavailable_datetime.datetime}</td>
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
                    <td>${schedule.message}</td>
                    <td>${schedule.message}</td>
                </tr>
            `);
        })
    }

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
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }

                $(this).trigger("reset");
                getServices();
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
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }

                $(this).trigger("reset");
                getUnavailableDatetimes();
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
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }

                getServices();
                getUnavailableDatetimes();
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

            default:
                break;
        }
    });

    getServices();
    getUnavailableDatetimes();
    getSchedules();
});
