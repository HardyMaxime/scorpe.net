import { isDefined, throttle } from './helpers';

export function initService() {
    const sections = document.querySelectorAll('.service-timeline-item');
    //const sections = document.querySelectorAll('.test');
    if(!isDefined(sections)) return;
    //initShowSection(sections);
    updateProgressbar(sections);
}

// fonction pour mettre à jour la barre de progression de chaque sections
function updateProgressbar(sections)
{
    window.addEventListener('scroll', throttle(function() {
        sections.forEach(function(section) {
            if(section.classList.contains('is-completed')) return;

            let scrollPercentage = 0;
            const progressbar = section.querySelector('.service-timeline-progress-bar');
            scrollPercentage = (getVisibilityPercentage(section));
            progressbar.style.height = scrollPercentage + "%";

            if(scrollPercentage > 10)
            {
                //setTimeout(function() {
                    section.classList.add('is-reached');
                //}, 500);
            }

            if(scrollPercentage > 80)
            {
                section.classList.add('is-completed');
                progressbar.style.height = "100%";
            }
        });
    }, 100));
}
/*
function calculateVisibilityPercentage(element)
{
      // Récupérer les coordonnées de l'élément
      const rect = element.getBoundingClientRect();
      // Récupérer la hauteur de l'élément
      const hauteurElement = rect.height;
      // Récupérer la distance entre le haut de l'élément et le haut de la fenêtre
      const distanceAuHaut = rect.top;
      // Calculer le pourcentage de visibilité en utilisant la formule suivante :
      // (hauteur de l'élément - distance entre le haut de l'élément et le haut de la fenêtre) / hauteur de l'élément * 100
      const pourcentageVisibilite = (hauteurElement - distanceAuHaut) / hauteurElement * 100;
      // Retourner le pourcentage de visibilité arrondi à deux décimales
      return Math.round(pourcentageVisibilite * 100) / 100;
}
*/

/*
function getVisibilityPercentage(element) {
    const rect = element.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    const windowWidth = window.innerWidth || document.documentElement.clientWidth;

    // Si l'élément est complètement hors de la vue
    if (rect.bottom < 0 || rect.top > windowHeight || rect.left > windowWidth || rect.right < 0) {
        return 0;
    }

    // Hauteur et largeur visibles de l'élément
    const visibleHeight = Math.min(rect.bottom, windowHeight) - Math.max(rect.top, 0);
    const visibleWidth = Math.min(rect.right, windowWidth) - Math.max(rect.left, 0);

    const elementArea = rect.height * rect.width;
    const visibleArea = visibleHeight * visibleWidth;

    return (visibleArea / elementArea) * 100;
}
*/

function getVisibilityPercentage(element) {
    const rect = element.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;

    const elementMidpoint = (rect.top + (rect.height / 2) + (rect.height / 2));

    // Si le milieu de l'élément est au-delà du milieu de la fenêtre
    if (elementMidpoint <= windowHeight / 2) {
        return 100;
    }

    // Si le bas de l'élément est au-dessus du haut de la fenêtre
    if (rect.bottom < 0) {
        return 0;
    }

    // Calculer le pourcentage de visibilité basé sur la distance entre le milieu de l'élément et le milieu de la fenêtre
    const distanceToMidpoint = elementMidpoint - (windowHeight / 2);
    const percentage = 100 - ((distanceToMidpoint / rect.height) * 100);

    return Math.max(0, percentage);
}


/*
function calculateVisibilityPercentage(element, gap) {
    const elementRect = (element.getBoundingClientRect());
    const windowHeight = window.innerHeight;
    const bottomVisiblePosition = (Math.min(elementRect.bottom, windowHeight));
    const visibleHeight = (bottomVisiblePosition - elementRect.top);
    const visibilityPercentage = (visibleHeight / elementRect.height) * 100;
    return (visibilityPercentage);
}
*/