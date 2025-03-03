import { isDefined } from './helpers';

export function initConception() {
    openBox();
    closeBox();
}

function openBox()
{
    const buttons = document.querySelectorAll('.button-show-image');
    const box = document.querySelector('.conception-image');
    if(!isDefined(buttons) || !isDefined(box)) return;

    buttons.forEach(function(button) {
        button.addEventListener('click', function(){
            const image = box.querySelector('img');
            if(!isDefined(image)) return;
            const src = this.getAttribute('data-image');
            if(!isDefined(src)) return;
            image.setAttribute('src', src);
            box.classList.add('show');
        });
    });
}

function closeBox()
{
    const box = document.querySelector('.conception-image');
    if(!isDefined(box)) return;
    const close = box.querySelector('.conception-image-close');
    if(!isDefined(close)) return;

    close.addEventListener('click', function(){
        box.classList.remove('show');
    });
}
