import { isDefined } from './helpers';
import Splide from '@splidejs/splide';

export function initProduct() {
    initSliderCrossselling();
}

function initSliderCrossselling() {
    const wrapper = document.querySelector('#product-crossselling-slider');
    if(!isDefined(wrapper)) return;

    let slider = new Splide( wrapper, {
        type: "slide",
        speed : "2000",
        interval : "5000",
        perPage : "4",
        pagination:false,
        autoplay: false,
        waitForTransition: false,
        updateOnMove: true,
        arrows: false,
        pauseOnHover: true,
        pauseOnFocus: false,
        mediaQuery: 'max',
        gap: 40,
        breakpoints: {
            1024: {
                perPage: 3,
                gap: 20,
            },
            768: {
                perPage: 2,
                gap: 20,
                fixedWidth: 235
            },
            480: {
                perPage: 1,
                gap: 20,
            }
        }
    });

    slider.mount();
}