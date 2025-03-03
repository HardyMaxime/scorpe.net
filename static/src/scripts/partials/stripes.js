import { throttle } from './helpers';

export function initStripes() {
    window.addEventListener('scroll', throttle(handleScrollPosition, 100), { passive: true });
}

/**
 *  Detecte sur le scroll descend ou remonte
 */
function handleScrollPosition()
{
    let scrollPosition = window.scrollY;
    let scrollDirection = scrollPosition > window.lastScrollPosition ? 'down' : 'up';
    window.lastScrollPosition = scrollPosition;

    if (scrollDirection === 'down') {
        document.body.classList.add('scrolling-down');
        document.body.classList.remove('scrolling-up');
    } else {
        document.body.classList.add('scrolling-up');
        document.body.classList.remove('scrolling-down');
    }
}