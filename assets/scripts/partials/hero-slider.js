import { isDefined } from './helpers';
import { Splide } from '@splidejs/splide';

export function initHeroSlider() {
    initFigureSlider();
}

function initFigureSlider()
{
    const slider = document.querySelector('.section-contect-figure');
    if(!isDefined(slider)) return;

    const slider_figure = new Splide( slider, {
        width : '100%',
        height: '100%',
        waitForTransition: false,
        pagination: false,
        arrows: false,
        type: 'fade',
        rewind: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        drag: true,
        autoplay:true,
        lazyLoad: false,
        interval: 5000
    });
    slider_figure.mount();
}