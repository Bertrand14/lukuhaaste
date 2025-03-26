import Splide from "@splidejs/splide";

function getBreakpoints(maxNb) {
    const imgNb = Array.from({ length: maxNb }, (_, index) => index + 1);
    let breakpoints = {};
    imgNb.forEach((nb) => {
        breakpoints[nb * 150] = { perPage: nb };
    });
    return breakpoints;
}

function initializeSplide() {
    const allSplides = document.querySelectorAll(".splide");
    const maxImgNb = 12;
    const breakpoints = getBreakpoints(maxImgNb - 1);

    allSplides.forEach((splide) => {
        new Splide(splide, {
            type: "loop",
            autoplay: false,
            perPage: maxImgNb,
            gap: "1rem",
            breakpoints: breakpoints,
        }).mount();
    });
}

try {
    document.addEventListener("DOMContentLoaded", initializeSplide);
} catch (err) {
    console.error(err);
}
