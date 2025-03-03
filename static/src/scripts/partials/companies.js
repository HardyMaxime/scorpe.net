import { isDefined } from './helpers';
import { Splide } from '@splidejs/splide';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';

export function initCompanies() {
    initSlidersCompanies();
}

function initSlidersCompanies()
{
    const slider = document.querySelector('#partner-slider');
    if(!isDefined(slider)) return;
    let sliderPartenaires = new Splide( slider, {
        type   : 'loop',
        drag   : 'free',
        focus  : 'center',
        fixedHeight: '80px',
        pagination:false,
        waitForTransition: false,
        pauseOnHover: true,
        pauseOnFocus: false,
        updateOnMove: true,
        perPage: 2,
        gap: 60,
        mediaQuery: 'min',
        arrows: false,
        autoScroll: {
            speed: 1,
        },
        breakpoints: {
            1400: 
            {
                perPage: 7,
            },
            1190:
            {
                perPage: 5,
            },
            800:
            {
                perPage: 4,
                autoScroll: {
                    speed: 1,
                },
            },
            400:
            {
                perPage: 2,
            }
        }
    });
    sliderPartenaires.mount({AutoScroll});
}
