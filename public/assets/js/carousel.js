$(document).ready(function () {
    $("#owl-carousel").owlCarousel({
        items: 6,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        slideSpeed: 900,
        loop: true,
        nav: true,
        navText: ["<button class='owl-prev'><span>&lt;</span></button>", "<button class='owl-next'><span>&gt;</span></button>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });


    $("#owl-demo-5").owlCarousel({
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        loop: true,
        items: 6,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            900: {
                items: 6
            }
        }
    });
});
