import { isDefined } from './helpers';

export function initGallery() {
    manageGallery();
}

function manageGallery()
{
    const loadMoreButton = document.getElementById('show-more-gallery');
    const galleryWrapper = document.querySelector('.gallery-wrapper');

    if(!isDefined(galleryWrapper)) return;

    const pageId = parseInt(galleryWrapper.dataset.id);

    loadMoreButton.addEventListener("click", function(e) {
        e.preventDefault();

        const max = galleryWrapper.dataset.max;
        const offset = galleryWrapper.dataset.offset;

        const formData = new FormData();
        formData.append( 'action', 'gallery' );
        formData.append( 'offset', offset );
        formData.append( 'max', max );
        formData.append( 'pageId', pageId );
        formData.append( 'nonce', ajax_var.nonce );

        fetch(ajax_var.url, {
            method: "POST",
            credentials: 'same-origin',
            body: formData
        })
        .then((response) => response.json())
        .then((data) => {
            for(let i = 0; i < data['gallery'].length; i++)
            {
                galleryWrapper.appendChild(createCard(data['gallery'][i].url, data['gallery'][i].alt));
            }
            hideButtonMore(data['isLastRow']);
            changeRange();
            window.lightbox.reload();
        });
    });
}

function createCard(url, alt)
{
    let anchor = document.createElement('a');
    anchor.classList.add("gallery-wrapper-item", "glightbox");
    anchor.href = url;

    let img = document.createElement('img');
    img.setAttribute('src', url);
    img.setAttribute('width', '670');
    img.setAttribute('height', '420');
    img.setAttribute('alt', alt);
    img.setAttribute('loading', 'lazy');

    anchor.appendChild(img);
    return anchor;
}

function changeRange()
{
    const galleryWrapper = document.querySelector('.gallery-wrapper');
    if(!isDefined(galleryWrapper)) return;
    galleryWrapper.dataset.offset = parseInt(galleryWrapper.dataset.max) + parseInt(galleryWrapper.dataset.offset);
}

function hideButtonMore(isLastRow)
{
    const loadMoreButton = document.getElementById('show-more-gallery');
    if(!isDefined(loadMoreButton)) return;
    if(isLastRow)
    {
        loadMoreButton.remove();
    }
}