const allImages = $("img");

allImages.each(function () {
    const image = $(this); 
    
    const src = image.attr("src");
    const loader = new Image();
    loader.src = src; 

    if (loader.complete) {
        image.addClass("loaded");
    } else {
        loader.onload = function () {
            image.addClass("loaded");
        };
    }
});

const sr = ScrollReveal({
    origin: "top",
    distance: "50px",
    duration: 1500,
    opacity: 0,
});

sr.reveal(".delay-small", { delay: 200 });
sr.reveal(".delay-medium", { delay: 300 });
sr.reveal(".delay-large", { delay: 400 });

sr.reveal(".interval-small", { interval: 200 });
sr.reveal(".interval-medium", { interval: 300 });