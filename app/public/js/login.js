$(document).ready(function () {
    const updateFormAlert = (type, message) => {
        $(".form__alert").html(`<div class="${type}"><p>${message}</p></div>`);
    };

    $('form').submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const action = $(this).attr('action');

        $(".form__alert").empty();

        $.post(action, formData)
            .done(data => {
                const response = JSON.parse(data);

                if (response.error) {
                    updateFormAlert("error", response.error);
                    return;
                }
                
                const hasRedirect = String(window.location.href).includes("?redirect=schedule");
                updateFormAlert("success", response.success);
                setTimeout(() => {
                    window.location.href = hasRedirect ? response.url + "schedule" : response.url;
                }, 600);
            })
    });
});
