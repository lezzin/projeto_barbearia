$(document).ready(function () {
    const updateFormAlert = (type, message) => {
        $(".form__alert").html(`<div class="${type} mt"><p>${message}</p></div>`);
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

                updateFormAlert("success", response.success);
                setTimeout(() => {
                    window.location.href = response.url;
                }, 600);
            })
    });
});
