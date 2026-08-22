document.addEventListener('DOMContentLoaded', function () {

    const slider = document.querySelector('.mySwiper');

    if (!slider) {
        return;
    }

    new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 20,

        loop: true,

        autoplay: {
            delay: 3000,
            disableOnInteraction: false
        },

        pagination: {
            el: slider.querySelector('.swiper-pagination'),
            clickable: true
        },

        navigation: {
            nextEl: slider.querySelector('.swiper-button-next'),
            prevEl: slider.querySelector('.swiper-button-prev')
        },

     
    });

});