import { isDefined } from './helpers';
import Splide from '@splidejs/splide';

export function initProduct() {
    initSliderCrossselling();
    initSliderPreview();
    //initPreview();
    //initMagnifier();
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

function initSliderPreview()
{
    const wrapper = document.querySelector('#product-preview-slider');
    if(!isDefined(wrapper)) return;

    let slider = new Splide( wrapper, {
            type: "slide",
            speed : "1000",
            interval : "5000",
            perPage : "1",
            width: "100%",
            perMove: 1,
            pagination:false,
            autoplay: false,
            waitForTransition: false,
            updateOnMove: true,
            arrows: true,
            pauseOnHover: true,
            pauseOnFocus: false,
            mediaQuery: 'max',
            gap: 15,
            breakpoints: {
                900: {
                    fixedWidth: 290,
                }
            }
        }
    );
    const thumbs = document.querySelectorAll('.product-thumb');
    slider.on( 'mounted move', function () {
        changeActiveThumb(slider.index);
        if (window.matchMedia("(max-width: 900px)").matches) {
        // media query mobile 
            const bar = slider.root.querySelector( '.slider-progress-bar' );
            const currentSlideIndex = slider.root.querySelector(".slider-progress-current");
            if(!isDefined(bar) || !isDefined(currentSlideIndex)) return;
            currentSlideIndex.innerHTML = String(slider.index + 1);
            let end  = slider.Components.Controller.getEnd() + 1;
            let rate = Math.min( ( slider.index + 1 ) / end, 1 );
            bar.style.width = String( 100 * rate ) + '%';
        }
    });

    slider.mount();

    if(isDefined(thumbs))
    {
        thumbs.forEach(function(thumb){
            thumb.addEventListener('click', function(e){
                e.preventDefault();
                const index = this.getAttribute('data-slide-index');
                slider.go(Number(index));
            });
        });
    }
}

function changeActiveThumb(index)
{
    const thumbs = document.querySelectorAll('.product-thumb');
    if(!isDefined(thumbs)) return;
    thumbs.forEach(function(thumb){
        thumb.classList.remove('active');
        if(thumb.getAttribute('data-slide-index') == Number(index))
        {
            thumb.classList.add('active');
        }
    });
}

/*
function initPreview()
{
    const previewWrapper = document.querySelector('.product-preview-image img');
    if(!isDefined(previewWrapper)) return;

    const thumbs = document.querySelectorAll('[data-image-preview]');
    if(!isDefined(thumbs)) return;

    thumbs.forEach(function(thumb){
        thumb.addEventListener('click', function(e){
            e.preventDefault();
            resetActiveThumb(thumbs);
            const image = this.getAttribute('data-image-preview');
            this.classList.add('current-show');
            previewWrapper.src = image;
        });
    });
}

function resetActiveThumb(thumbs)
{
    thumbs.forEach(function(thumb){
        thumb.classList.remove('current-show');
    });
}

function initMagnifier()
{
    const magnifier = document.querySelector('.img-magnifier-container');
    if(!isDefined(magnifier)) return;

    magnifier.addEventListener('click', function(e){
        e.preventDefault();
        if(this.classList.contains('magnifier-is-open'))
        {
            this.classList.remove('magnifier-is-open');
            magnify(".img-magnifier-container img", 1.5, false);
        }
        else
        {
            this.classList.add('magnifier-is-open');
            magnify(".img-magnifier-container img", 1.5, true);
        }

    });

    buttonOpen.addEventListener('click', function(e){
        e.preventDefault();
        magnifier.classList.add('magnifier-is-open');
        magnify(".img-magnifier-container img", 1.5, true);
    });

    buttonClose.addEventListener('click', function(e){
        this.parentNode.classList.remove('magnifier-is-open');
        magnifier.classList.remove('magnifier-is-open');
        magnify(".img-magnifier-container img", 1.5, false);
    });
}

function magnify(imgID, zoom, isOpen) {

    let img, glass, w, h, bw;
    img = document.querySelector(imgID);
    let hasGlass = document.querySelector(".img-magnifier-glass") !== null;
    if(!hasGlass)
    {
        glass = buildMagnifier(img, zoom);
        img.parentElement.insertBefore(glass, img);
    }
    else {
        glass = document.querySelector(".img-magnifier-glass");
    }

    bw = 3;
    w = glass.offsetWidth / 2;
    h = glass.offsetHeight / 2;

    if(isOpen)
    {
        glass.addEventListener("mousemove", glass.fn = function(e)
        {
            moveMagnifier(e, img);
        }); 
        img.addEventListener("mousemove", img.fn = function(e){
            moveMagnifier(e, img);
        });

        glass.addEventListener("touchmove", glass.fn = function(e){
            moveMagnifier(e, img);
        });
        img.addEventListener("touchmove", img.fn = function(e){
            moveMagnifier(e, img);
        });
    }
    else {
        destroyMagnifier(glass, img);
    }

    function moveMagnifier(e, img) {
        var pos, x, y;
        
        e.preventDefault();
       
        pos = getCursorPos(e, img);
        x = pos.x;
        y = pos.y;
        
        if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
        if (x < w / zoom) {x = w / zoom;}
        if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
        if (y < h / zoom) {y = h / zoom;}

        glass.style.left = (x - w) + "px";
        glass.style.top = (y - h) + "px";

        glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
    }
}

function buildMagnifier(img, zoom)
{
    const glass = document.createElement("DIV");
    glass.setAttribute("class", "img-magnifier-glass");
    glass.style.backgroundImage = "url('" + img.src + "')";
    glass.style.backgroundRepeat = "no-repeat";
    glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
    glass.style.backgroundColor = "#ffffff";

    return glass;
}

function destroyMagnifier(glass, img)
{
    glass.removeEventListener("mousemove", glass.fn, false);
    glass.removeEventListener("touchmove", img.fn, false);
    img.removeEventListener("mousemove", glass.fn, false);
    img.removeEventListener("touchmove", img.fn, false);
    glass.remove();
}

function getCursorPos(e, img) {
    var a, x = 0, y = 0;
    e = e || window.event;
    
    a = img.getBoundingClientRect();

    x = e.pageX - a.left;
    y = e.pageY - a.top;

    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
}
*/