import { isDefined, throttle } from './helpers';

export function initTopbar() {
    topbar();
}

function topbar()
{
    const header = document.querySelector('.header');
    if(!isDefined(header)) return;
    const headerHeight = header.offsetHeight;
    const topbar = document.querySelector('.js-header-topbar');
    if(!isDefined(topbar) || topbar.classList.contains("no-js-topbar")) return;
    const topbarHeight = topbar.offsetHeight;
    const marge = 50;

    window.addEventListener('scroll', throttle(handleScrollTopbar, 100), { passive: true });
    handleScrollTopbar();

    function handleScrollTopbar()
    {
        let scrollPosition = window.scrollY;
        if(scrollPosition > (topbarHeight + marge))
        {
            topbar.classList.add('fixed-topbar');
            header.style.setProperty('padding-top', `${topbarHeight}px`);
        }
        else {
            topbar.classList.remove('fixed-topbar');
            header.style.setProperty('padding-top', `0px`);
        }

        if(scrollPosition > headerHeight) {
            topbar.classList.add('fixed-topbar-appear');
        }
        else {
            topbar.classList.remove('fixed-topbar-appear');
        }
    }
}
