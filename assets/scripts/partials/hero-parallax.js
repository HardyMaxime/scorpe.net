import { isDefined } from './helpers';
import { ParallaxController } from 'parallax-controller';

export function initHeroParallax()
{
    const parallaxElement = document.querySelectorAll('[data-speed]');
    if(!isDefined(parallaxElement)) return;

    parallaxElement.forEach(function(item) {
        let speed = item.dataset.speed;
        let wrapper;
        let props = {};

        if(isDefined(item.dataset.wrapper))
        {
            wrapper =document.querySelector('.'+item.dataset.wrapper);
        }
        else
        {
            wrapper = document.body;
        }

        let instance = ParallaxController.init({
            wrapper
        });

        if(isDefined(item.dataset.translateStart) && isDefined(item.dataset.translateEnd))
        {
            let translate = [item.dataset.translateStart, item.dataset.translateEnd]; 
            props.translateY = translate;
        }

        props.speed = parseInt(speed);
        //props.easing = "ease";
        //props.scale = 0.5;
        //props.easing = [.55,.79,.88,.97];
        props.easing = [.55,.79,.38,.47];
        //props.rootMargin = { top: 100, right: 100, bottom: 100, left: 100 };
        props.shouldAlwaysCompleteAnimation = true;
        //props.startScroll = 0;
        //props.endScroll = 0;

        /*
        props.onProgressChange = function(progress) {
            console.log(progress);
            console.log(lerp(0, 1, progress));
            console.log(this)
            item.style.setProperty("opacity", lerp(0, 1, progress));
        };
        */

        let options = {
            el: item,
            props: props,
        };

        instance.createElement(options);
    })
}

function lerp (start, end, amt){
    return (1-amt)*start+amt*end
}