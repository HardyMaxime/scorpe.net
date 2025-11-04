import { isDefined } from './helpers';

export function initHeader() {
    changeBackgroundMenu();
    openMenu();
    closeMenu();
}

function changeBackgroundMenu() 
{
    const ratio_to_show = 10;
    function changeBackground() {
        let scrollTop =  window.scrollY;
        if(scrollTop >= ratio_to_show)
        {
            document.body.classList.add('is-scrolled')
        }
        else {
            if(document.body.classList.contains('is-scrolled'))
            {
                document.body.classList.remove('is-scrolled')
            }
        }
    }

    changeBackground()
    window.addEventListener('scroll',function() {
        changeBackground();
    }, { passive: true });
}

function openMenu()
{
    const button = document.querySelector('.navbar-menu-button');
    const menu = document.querySelector('.menu-wrapper');
    if(!isDefined(button) || !isDefined(menu)) return;

    button.addEventListener('click', function() {
        document.body.classList.add('menu-is-open');
        if(menu.classList.contains('is-hidden'))
        {
            menu.classList.remove('is-hidden');
        }
    });
}

function closeMenu()
{
    const button = document.querySelector('.menu-button-close');
    const menu = document.querySelector('.menu-wrapper');
    const backdrop = document.querySelector('.menu-background');
    if(!isDefined(button) || !isDefined(menu) || !isDefined(backdrop)) return;

    button.addEventListener('click', closeMenuScript, true);

    //backdrop.addEventListener('click', closeMenuScript);

    //Quand on appuye sur la touche escape
    document.addEventListener('keydown', function(event) {
        if(event.key === "Escape") {
            closeMenuScript();
        }
    }, true);

    function closeMenuScript()
    {
        if(document.body.classList.contains('menu-is-open'))
        {
            document.body.classList.remove('menu-is-open');
        }
        setTimeout(function(){
           menu.classList.add('is-hidden');
        }, 1000);
    }
}