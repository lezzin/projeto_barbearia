$(document).ready(function () {    
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
            })
    });

    $('[data-delete-url]').click(function() {
        const action = $(this).attr('data-delete-url');
        const alert = $(this).parents(".container").children("form").children(".form__alert");

        $.post(action)
            .done(data => {
                const response = JSON.parse(data);
                alert.empty();

                if(response.success) {
                    alert.append(`<div class="success"><p>${response.success}</p></div>`);
                    $(this).parents("tr").remove();
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }
            })
    });

    $('[data-edit-table]').click(function() {
        const table = $(this).attr('data-edit-table');
        const id = $(this).attr('data-id');
        const alert = $(this).parents(".container").children("form").children(".form__alert");

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

        return;

        $.post(action)
            .done(data => {
                const response = JSON.parse(data);
                alert.empty();

                if(response.success) {
                    alert.append(`<div class="success"><p>${response.success}</p></div>`);
                    $(this).parents("tr").remove();
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }
            })
    });

// io
});
