import { isDefined } from './helpers';
import { Splide } from '@splidejs/splide';

export function initHeroSlider() {
    initSlidersHeader();
}

function initSlidersHeader()
{
    const sliderWrappers = document.querySelectorAll('.has-hero-slider');

    if(!isDefined(sliderWrappers) ) return;
    sliderWrappers.forEach(function(heroSlider){

        const sliderTextWrapper = heroSlider.querySelector('.hero-slider-content');
        const backgroundSlider = heroSlider.querySelector('.hero-slider-backgrounds');


        if(!isDefined(sliderTextWrapper) || !isDefined(backgroundSlider) ) return;
        const interval = (sliderTextWrapper.dataset.interval ? sliderTextWrapper.dataset.interval : 3000);

        const sliderText = new Splide( sliderTextWrapper, {
            type: "fade",
            speed : "2000",
            interval : interval,
            pagination:false,
            autoplay: true,
            waitForTransition: false,
            arrows: false,
            pauseOnHover: false,
            pauseOnFocus: false,
            updateOnMove: true,
            //lazyLoad: 'nearby',
            rewind: true,
            gap: 0,
            mediaQuery: 'max',
            breakpoints: {
                900: {
                    autoplay: false,
                    autoHeight: true
                },
            }
        });

        const sliderBackground = new Splide( backgroundSlider, {
            width : '100vw',
            height: '100%',
            waitForTransition: false,
            pagination: false,
            arrows: false,
            type: 'fade',
            rewind: true,
            pauseOnHover: false,
            pauseOnFocus: false,
            drag: false,
            lazyLoad: false
        });

        // Synchronisation des sliders
        sliderText.sync(sliderBackground);

        manageAsideControl(heroSlider, sliderText);

        sliderText.mount();
        sliderBackground.mount();
    });
}

function manageAsideControl(parent ,sliderText)
{
    const thumbnails = parent.querySelectorAll( '.hero-slider-pagination-item' );
    const bars = parent.querySelectorAll( '.hero-slider-pagination-item-progress-bar' );
    let current;

    for ( let i = 0; i < thumbnails.length; i++ ) {
        initThumbnail( thumbnails[ i ], i );
    }

    // The function to initialize each thumbnail.
    function initThumbnail( thumbnail, index ) {
        thumbnail.addEventListener( 'mouseover', function () {
            console.log('hover')
            sliderText.go( index );
        });
    }

    sliderText.on( 'mounted move', function () {
        const thumbnail = thumbnails[ sliderText.index ];

        if ( thumbnail ) {
          if ( current ) {
            current.classList.remove( 'is-active' );
          }

          thumbnail.classList.add( 'is-active' );
          current = thumbnail;
        }
    });

    sliderText.on( 'autoplay:playing', function ( rate ) {
        for ( var i = 0; i < bars.length; i++ ) {
            bars[i].style.width = String( 100 * ( rate )) + '%';
        }
    });
}