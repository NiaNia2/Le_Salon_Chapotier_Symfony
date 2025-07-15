//import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

const paragraphs = document.querySelectorAll('.conte');
const delayBetweenWords = 150;
const delayBetweenParagraphs = 600;
// permet d'utiliser le code plus tard 
async function animateText() {
    for (const paragraph of paragraphs) {
        const sentence = paragraph.textContent.trim(); // trim enleve les espace debut et fin paragraph
        const words = sentence.split(' '); // permet d'afficher les mots un a un 

        // Cache le texte puis rend visible le paragraphe
        paragraph.textContent = '';
        paragraph.style.visibility = 'visible';

        for (const word of words) {
            const span = document.createElement('span');// cree un espace de mémoire
            span.classList.add('word');//ajout class a span pour enimation
            span.textContent = word; //mettre le texte de word dans span
            paragraph.appendChild(span); //ajoute le span a la fin 

            await new Promise(res => setTimeout(res, delayBetweenWords));// await:attend que promesse soir reolue,promise objet qui attend avant de se faire, res qui dit ok promise resolue, permet de faire pause avant de continuer
            span.style.opacity = '1'; //regle l'opaciter du texte 
            span.style.transform = 'translateY(0)';//se deplace verticalement et se remet a sa position de debut

        }

        await new Promise(res => setTimeout(res, delayBetweenParagraphs));
    }

    const boxBtn = document.getElementById('box-btn');// permet de faire la suite une fois la ligne effectuer
    if (boxBtn) {
        boxBtn.hidden = false; // rend visible le btn 
        boxBtn.style.display = 'flex'; // flax le btn 
        document.getElementById('btn-enter')?.focus()// trouve d'id se nommant " ", ? verifie si il eexiste, permet de placer le urseur au bonne nedroit
    }


}

window.addEventListener('DOMContentLoaded', animateText); // represente la page web, ecouter evenement,evenement ce chargeant une fois la page web charger , function qui fait commencer levenment 




