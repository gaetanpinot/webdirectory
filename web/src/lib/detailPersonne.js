import {URL_API_BASE} from './config';
import Handlebars from "handlebars";

const templatePersonneDetail = Handlebars.compile(
    document.querySelector("#templateDetailPersonne").innerHTML);

export function getDetailPersonne(uri) {
    let urlDetailPersonne = URL_API_BASE + uri;
    fetch(urlDetailPersonne).then((response) => {
            if (response.status === 200) {
                response.json().then((personne) => {
                    document.querySelector('#detailPersonne').innerHTML
                        = templatePersonneDetail(personne.data.personne);
                });

            }
        }
    )
}

export function addEventListnerDetailPersonne() {
    document.querySelectorAll(".personne").forEach((e) => {
        e.addEventListener('click', () =>
            getDetailPersonne(e.querySelector('input').value)
        );
    })
}