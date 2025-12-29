(function() {
	"use strict";

    window.onload = function(){

        // Back to Top
        const getId = document.getElementById("back-to-top");
        if (getId) {
            const topbutton = document.getElementById("back-to-top");
            topbutton.onclick = function (e) {
                window.scrollTo({ top: 0, behavior: "smooth" });
            };
            window.onscroll = function () {
                if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                    topbutton.style.opacity = "1";
                } else {
                    topbutton.style.opacity = "0";
                }
            };
        }

        // Preloader
        const getPreloaderId = document.getElementById('preloader');
        if (getPreloaderId) {
            getPreloaderId.style.display = 'none';
        }

        // Counter Js
        try {
            if ("IntersectionObserver" in window) {
                let counterObserver = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                        let counter = entry.target;
                        let target = parseInt(counter.innerText);
                        let step = target / 200;
                        let current = 0;
                        let timer = setInterval(function () {
                            current += step;
                            counter.innerText = Math.floor(current);
                            if (parseInt(counter.innerText) >= target) {
                            clearInterval(timer);
                            }
                        }, 10);
                        counterObserver.unobserve(counter);
                        }
                    });
                });

                let counters = document.querySelectorAll(".counter");
                    counters.forEach(function (counter) {
                    counterObserver.observe(counter);
                });
            }
        } catch {}

        // Background Image simpleParallax
        const simpleParallax = (elem, modifier) => {
            let paras = document.getElementsByClassName(elem);
            for (let i = 0; i < paras.length; i++) {
                paras[i].setAttribute(
                    "style",
                    "background-repeat: no-repeat; background-attachment: fixed; background-size: cover;background-position: center center;"
                );
            }
            const sp = () => {
                for (let i = 0; i < paras.length; i++) {
                    let x = paras[i].getBoundingClientRect().top / modifier;
                    let y = Math.round(x * 100) / 100;
                    paras[i].style.backgroundPosition = "center " + y + "px";
                }
                requestAnimationFrame(sp);
            };
            requestAnimationFrame(sp);
        };
        simpleParallax("bgImageParallax", 8);

        // Price Range JS
        const rangeInput = document.querySelectorAll(".range-input input"),
        priceInput = document.querySelectorAll(".price-input input"),
        range = document.querySelector(".range-slider .progress");
        let priceGap = 1000;
        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                maxPrice = parseInt(priceInput[1].value);
                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } 
                    else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });
        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                maxVal = parseInt(rangeInput[1].value);
                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } 
                    else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } 
                else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });

        // Home Area Range JS
        try {
            const rangeInput = document.querySelectorAll(".home-range-input input"),
            priceInput = document.querySelectorAll(".home-price-input input"),
            range = document.querySelector(".home-range-slider .home-progress");
            let priceGap = 1000;
            priceInput.forEach((input) => {
                input.addEventListener("input", (e) => {
                    let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);
                    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                        if (e.target.className === "input-min") {
                            rangeInput[0].value = minPrice;
                            range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                        } 
                        else {
                            rangeInput[1].value = maxPrice;
                            range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                        }
                    }
                });
            });
            rangeInput.forEach((input) => {
                input.addEventListener("input", (e) => {
                    let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);
                    if (maxVal - minVal < priceGap) {
                        if (e.target.className === "range-min") {
                            rangeInput[0].value = maxVal - priceGap;
                        } 
                        else {
                            rangeInput[1].value = minVal + priceGap;
                        }
                    } 
                    else {
                        priceInput[0].value = minVal;
                        priceInput[1].value = maxVal;
                        range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                        range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                    }
                });
            });
        } catch {}
    };

    // Image simpleParallax
    let image = document.getElementsByClassName('parallaxThumbnail');
    new simpleParallax(image, {
        orientation: 'right'
    });

    // Main Banner Swiper JS
    var SwiperTraveler = new Swiper(".main-banner-image-slider", {
        loop: true,
        spaceBetween: 25,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".main-banner-image-pagination",
            clickable: true,
        },
    });

    // Testimonials Swiper JS
    var SwiperTraveler = new Swiper(".testimonial-slider", {
        loop: true,
        spaceBetween: 25,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".testimonial-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 1
            },
            992: {
                slidesPerView: 2,
                centeredSlides: false,
            },
            1200: {
                slidesPerView: 2
            },
        }
    });

    // Featured Properties JS
    try {
        window.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.slide');
            for (let slide of slides) {
                    slide.addEventListener('click', () => {
                    clearActiveClasses();
                    slide.classList.add('active');
                });
            }
            function clearActiveClasses() { 
            slides.forEach((slide) => {
                slide.classList.remove('active');
            });
            }
        });
    } catch {}

    // Quote Swiper JS
    var SwiperTraveler = new Swiper(".quote-slider", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 1,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        },
    });

    // Partner Swiper JS
    var SwiperTraveler = new Swiper(".partner-slider", {
        loop: true,
        spaceBetween: 35,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 2
            },
            576: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 4
            },
            992: {
                slidesPerView: 5
            },
            1200: {
                slidesPerView: 7
            },
        }
    });

    // Houses Swiper JS
    var SwiperTraveler = new Swiper(".houses-slider", {
        loop: true,
        spaceBetween: 25,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 3
            },
            1200: {
                slidesPerView: 4
            },
            1600: {
                slidesPerView: 5
            },
        }
    });

    // Feedback Swiper JS
    var SwiperTraveler = new Swiper(".feedback-slider", {
        loop: true,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".feedback-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 2
            },
        }
    });

    // Properties Swiper JS
    var SwiperTraveler = new Swiper(".properties-slider", {
        loop: true,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".properties-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            },
            1600: {
                slidesPerView: 4
            },
        }
    });

    // Review Swiper JS
    var SwiperTraveler = new Swiper(".review-slider", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 1,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        },
    });

    // Featured Properties Swiper JS
    var SwiperTraveler = new Swiper(".featured-properties-slider", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".properties-pagination",
            clickable: true,
        },
        breakpoints: {
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 1
            },
        }
    });

    // Property Details Image Swiper JS
    var SwiperTraveler = new Swiper(".property-details-image-slider", {
        loop: true,
        spaceBetween: 0,
        centeredSlides: true,
        navigation: {
            nextEl: ".property-details-button-next",
            prevEl: ".property-details-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 1
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 2
            },
        }
    });

    // scrollCue
    scrollCue.init();

    /* Start "Residential Real Estate Demo" & "Development Real Estate Demo" Style JS
    =====================================================================================*/
    
    // RRE Properties Swiper JS
    var SwiperTraveler = new Swiper(".rre-properties-slider", {
        loop: true,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".properties-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".properties-button-next",
            prevEl: ".properties-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 1
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            },
        }
    });
    var SwiperTraveler = new Swiper(".rre-popular-properties-slider", {
        loop: true,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".properties-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".properties-button-next",
            prevEl: ".properties-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 1
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            },
            1600: {
                slidesPerView: 4
            },
        }
    });

    // RRE Review Swiper JS
    var SwiperTraveler = new Swiper(".rre-review-slider", {
        loop: true,
        spaceBetween: 40,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".review-button-next",
            prevEl: ".review-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 2
            },
        }
    });

    // Featured Developments Swiper JS
    var SwiperTraveler = new Swiper(".featured-developments-slider", {
        loop: true,
        spaceBetween: 25,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".featured-developments-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 4
            },
        }
    });

    // Floor Plan Slider JS
    var SwiperTraveler = new Swiper(".floor-plan-slider", {
        loop: true,
        spaceBetween: 25,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".floor-plan-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 1
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            },
            1600: {
                slidesPerView: 4
            },
        }
    });

    // Amenities & Features Slider JS
    var SwiperTraveler = new Swiper(".amenities-features-slider", {
        loop: true,
        spaceBetween: 25,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            prevEl: ".features-button-prev",
            nextEl: ".features-button-next",
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 3
            },
            1200: {
                slidesPerView: 4
            },
        }
    });

    /* End "Residential Real Estate Demo" & "Development Real Estate Demo" Style JS
    =====================================================================================*/

    /* Start "Urban Estate Demo" & "Private Residence" JS
    =======================================================*/

    // Urban Estate About Images Slider JS
    var SwiperTraveler = new Swiper(".urban-estate-about-images-slider", {
        loop: true,
        spaceBetween: 25,
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".about-pagination",
            clickable: true,
        },
    });

    // Urban Estate Properties Slider JS
    var SwiperTraveler = new Swiper(".urban-estate-properties-slider", {
        loop: true,
        spaceBetween: 35,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 1
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            },
            1600: {
                slidesPerView: 4
            },
        }
    });

    // Urban Estate Testimonial Slider JS
    var SwiperTraveler = new Swiper(".urban-estate-testimonial-slider", {
        loop: true,
        spaceBetween: 35,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 3
            },
            1200: {
                slidesPerView: 3
            },
        }
    });

    // Urban Estate Partner Slider JS
    var SwiperTraveler = new Swiper(".urban-estate-partner-slider", {
        loop: true,
        spaceBetween: 45,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 2
            },
            576: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 4
            },
            992: {
                slidesPerView: 5
            },
            1200: {
                slidesPerView: 7
            },
        }
    });

    // Listing Images Slider JS
    $('.properties-images-slider').owlCarousel({
        loop: true,
        margin: 15,
        nav: false,
        dots: true,
        items: 1,
        autoplay: true,
        autoplayHoverPause: true,
    });

    /* End "Urban Estate Demo" & "Private Residence" JS
    =====================================================*/

})();

// Header Sticky
window.addEventListener('scroll', event => {
    const height = 150;
    const { scrollTop } = event.target.scrollingElement;
    document.querySelector('#navbar').classList.toggle('sticky', scrollTop >= height);
});  

// Tooltip JS
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});