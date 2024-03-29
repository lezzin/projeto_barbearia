const sr = ScrollReveal({
    origin: "top",
    distance: "50px",
    duration: 2000,
    opacity: 0,
});

sr.reveal(".delay-small", { delay: 200 });
sr.reveal(".delay-medium", { delay: 300 });
sr.reveal(".delay-large", { delay: 400 });

sr.reveal(".interval-small", { interval: 200 });
sr.reveal(".interval-medium", { interval: 300 });