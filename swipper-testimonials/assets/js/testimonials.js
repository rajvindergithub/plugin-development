 var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 30,
        loop: true, // optional
        speed: 1000, // speed of transition between slides in ms (1000ms = 1s)
        autoplay: {
            delay: 2000, // time between slide changes in ms
            disableOnInteraction: false, // keep autoplay running after user interaction
        },
     breakpoints: {
        // when window width is <= 499px
        350: {
            slidesPerView: 1,
            spaceBetweenSlides: 30
        },
        // when window width is <= 999px
        999: {
            slidesPerView: 2,
            spaceBetweenSlides: 40
        }
    },
    });
