$(function () {
    const $h3Elements = $(".rates-container h3");

    let $widestElement = null;
    let maxWidth = 0;

    $h3Elements.each(function () {
        const width = $(this).width();

        if (width > maxWidth) {
            maxWidth = width;
            $widestElement = $(this);
        }
    });

    if ($widestElement !== null) {
        $h3Elements.css("min-width", maxWidth);
    }

    new Swiper('.swiper', {
        direction: 'horizontal',
        slidesPerView: 3,
        spaceBetween: 10,

        breakpoints: {
            320: {
                slidesPerView: 2
            },
            480: {
                slidesPerView: 3
            },
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    });
});