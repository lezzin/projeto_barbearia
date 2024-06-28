$(function () {
    const updateFormAlert = (type, message) => {
        $(".form-alert").html(`<div class="${type}"><p>${message}</p></div>`).fadeIn(200);
    };

    $('form').submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();
        const action = $(this).attr('action');

        $(".form-alert").fadeOut(200);

        $.post(action, formData)
            .done(data => {
                const response = JSON.parse(data);

                if (response.status !== 200) {
                    updateFormAlert("error", response.message);
                    return;
                }
                
                updateFormAlert("success", response.message);

                const hasRedirect = String(window.location.href).includes("?redirect=schedule");
                setTimeout(() => {
                    window.location.href = hasRedirect ? response.data.url + "schedule" : response.data.url;
                }, 600);
            })
    });
});
