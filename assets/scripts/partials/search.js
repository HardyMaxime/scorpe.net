import { isDefined } from './helpers';

export function initSearch() {
    openSearch();
    closeSearch();
    manageSearch();
}

function openSearch()
{
    const buttonOpen = document.querySelectorAll('.open-search');
    if(!isDefined(buttonOpen)) return;
    buttonOpen.forEach(function(button){
        button.addEventListener('click', function(e){
            e.preventDefault();
            document.querySelector('.search-wrapper').classList.add('is-open');
            document.body.classList.add('search-is-open');
            document.querySelector('#input-search').focus();
        });
    })
}

function closeSearch()
{
    const buttonClose = document.querySelector('#close-search');
    if(!isDefined(buttonClose)) return;

    buttonClose.addEventListener('click', function(e){
        e.preventDefault();
        document.querySelector('.search-wrapper').classList.remove('is-open');
        document.body.classList.remove('search-is-open');
    });

    document.addEventListener('keydown', function(e) {
        if(e.key === 'Escape'){
            if(document.body.classList.contains('search-is-open')){
                document.querySelector('.search-wrapper').classList.remove('is-open');
                document.body.classList.remove('search-is-open');
            }
        }
    })
}

function manageSearch()
{
    const searchBar = document.querySelector('#input-search');
    const formSearch = document.querySelector('.search-bar-form');
    const list = document.querySelector('#search-results-list');

    if(!isDefined(searchBar) || !isDefined(formSearch)) return;

    searchBar.addEventListener('keyup', function(e) {
        const formData = new FormData();
        formData.append( 'action', 'search_ajax' );
        formData.append( 'keyword', e.target.value );
        formData.append( 'nonce', ajax_var.nonce );

        if(e.target.value.length <= 2) {
            list.parentNode.classList.remove('show');
            return
        }
        else {
            list.parentNode.classList.add('show');
        }

        fetch(ajax_var.url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            list.innerHTML = '';
            if(Object.keys(data).length === 0) {
                noResultLink = createListElement("#", "No quick suggestions for your search, you can launch a classic search by clicking here", false);
                list.appendChild(noResultLink);
                noResultLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    formSearch.submit();
                });
            }
            for (var key of Object.keys(data)) {
                let item = data[key];
                list.appendChild(createListElement(item.permalink, item.title, item.type));
            }
        });
    });
}

function createListElement(permalink, title, type = false)
{
    const li = document.createElement('li');
    const span = document.createElement('span');
    const a = document.createElement('a');
    if(type !== false)
    {
        span.classList.add('search-bar-results-type');
        span.innerHTML = type
    }
    a.href = permalink;
    a.innerHTML = title;
    a.title = title;
    a.appendChild(span);
    li.appendChild(a);
    return li;
}