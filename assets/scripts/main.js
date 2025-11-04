import './../styles/main.scss'; 
import { triggerRevealScroll } from './partials/scroll-reveal';
import { preloadTransition } from './partials/preload-transition';
import { initHeroSlider } from './partials/hero-slider';
import { initHeader } from './partials/header';
import { initCompanies } from './partials/companies';
import { initService } from './partials/service';
import { initProduct } from './partials/product';
import { initCookieConsent } from './partials/cookie-consent';
import { initSearch } from './partials/search';
import { initGallery } from './partials/gallery';
import { initHeroParallax } from './partials/hero-parallax';
import GLightbox from 'glightbox';
import { isDefined } from './partials/helpers';

window.addEventListener('DOMContentLoaded', function() {
    if('IntersectionObserver' in window)
    {
        document.documentElement.classList.add('reveal-loaded')
        triggerRevealScroll();
    }

    setTimeout(function() {
        preloadTransition();
    }, 100);

    initHeroSlider();
    initHeader();
    initCompanies();
    initService();
    initProduct();
    initCookieConsent();
    initSearch();
    initGallery();
    clipBoard();

    if (window.matchMedia("(min-width: 999px)").matches) {
        initHeroParallax();
    }

    window.lightbox = GLightbox();

    document.querySelectorAll('.details-content table').forEach(function (table) {
        const wrapper = document.createElement('div');
        wrapper.classList.add('table-wrapper', 'remove-br');

        wrapper.append(table.cloneNode(true));
        table.parentNode.replaceChild(wrapper, table);

        let labels = Array.from(table.querySelectorAll('thead th')).map(function (th) {
            return th.innerText
        });

        if(isDefined(wrapper.querySelector('table')))
        {
            wrapper.querySelector('table').querySelectorAll('td').forEach(function (td, i) {
                td.setAttribute('data-label', labels[i % labels.length])
            });
        }

        while(isBr(wrapper.previousElementSibling)) {
            wrapper.previousElementSibling.remove();
        }
    });

    function isBr(el) {
        return el && el.nodeType == 1 && el.tagName == "BR";
    }
});

function clipBoard()
{
    const buttons = document.querySelectorAll('.clipboard-button') || null;
    if(!isDefined(buttons)) return;

    buttons.forEach(function(button) {
        const tooltip = button.querySelector('.clipboard-tooltip') || null;
        button.addEventListener('click', function() {
            const text = this.dataset.url;
            navigator.clipboard.writeText(text);
            if(tooltip)
            {
                tooltip.innerText = tooltip.dataset.textPaste || "Copied";
            }
        });

        if(tooltip)
        {
            button.addEventListener('mouseleave', function() {
                tooltip.innerText = tooltip.dataset.text || "Clipboard";
            });
        }
    });
}