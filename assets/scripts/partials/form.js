import { isDefined } from './helpers';
import flatpickr from "flatpickr";
import { French } from "flatpickr/dist/l10n/fr.js"

export function initForm() {
    openForm();
    closeForm();
    flatPickr();
}

function openForm()
{
    const opens = document.querySelectorAll('.js-open-form');
    if(!isDefined(opens)) return;
    opens.forEach(function(open) {
        open.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.add('form-is-open');
        })
    })
}

function closeForm()
{
    const closes = document.querySelectorAll('.js-close-form');
    if(!isDefined(closes)) return;
    closes.forEach(function(close) {
        close.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.remove('form-is-open');
        })
    })
    //ajoute une classe sur le form wrapper
}

function flatPickr()
{
    const inputDate = document.querySelector('.js-date') || null;
    if(isDefined(inputDate))
    {
        flatpickr(inputDate, {
            dateFormat: "d M Y",
            locale: French,
        });
    }

    const inputTime = document.querySelector('.js-time') || null;
    if(isDefined(inputTime))
    {
        flatpickr(inputTime, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            locale: French,
        });
    }
}
