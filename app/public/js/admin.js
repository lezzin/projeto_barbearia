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

// io
});
