import { isDefined } from './helpers';
import Splide from '@splidejs/splide';

export function initTemoignages() {
    const temoignagesWrapper = document.querySelector('.testimonies-listing');
    if(!isDefined(temoignagesWrapper)) return;

    let slider = new Splide( temoignagesWrapper, {
        type: "loop",
        speed : "2000",   
        interval : "5000",
        perPage : "1",
        pagination:true,
        autoplay: true,
        waitForTransition: false,
        updateOnMove: true,
        arrows: false,
        pauseOnHover: true,
        pauseOnFocus: false,
        mediaQuery: 'max',
    });

    slider.mount();
}
