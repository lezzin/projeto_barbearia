$(function () {
    const updateFormAlert = (type, message) => {
        $(".form-alert").html(`<div class="${type} mt"><p>${message}</p></div>`).fadeIn(200);
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

                setTimeout(() => {
                    window.location.href = response.data.url;
                }, 600);
            })
    });
});
