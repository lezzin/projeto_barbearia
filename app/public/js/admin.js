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
                    alert.append(`<div class="success"><p>${response.success}</p></div> `);
                } else {
                    alert.append(`<div class="error"><p>${response.error}</p></div>`);
                }
            })
    });

// io
});
