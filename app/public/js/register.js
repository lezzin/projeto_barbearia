$(document).ready(function () {    
    $('form').submit(function(e) {
        e.preventDefault();
    
        const formData = $(this).serialize();
        const action = $(this).attr('action');
    
        $.post(action, formData)
            .done(data => {
                const response = JSON.parse(data);

                $(".form__alert").empty();
                
                if(response.success) {
                    $(".form__alert").append(`
                        <div class="success">
                            <p>${response.success}</p>
                        </div>
                    `);

                    setTimeout(() => {
                        window.location.href = response.url;
                    }, 600);
                } else {
                    $(".form__alert").append(`
                        <div class="error">
                            <p>${response.error}</p>
                        </div>
                    `);
                }
            })
    });

// io
});
