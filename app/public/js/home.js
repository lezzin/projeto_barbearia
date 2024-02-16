const $h3Elements = $(".rates__container h3");

let $widestElement = null;
let maxWidth = 0;

$h3Elements.each(function() {
    const width = $(this).width();

    if (width > maxWidth) {
        maxWidth = width;
        $widestElement = $(this);
    }
});

if ($widestElement !== null) {
    $h3Elements.css("min-width", maxWidth);
}