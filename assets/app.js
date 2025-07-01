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

async function animateText() {
    for (const paragraph of paragraphs) {
        const sentence = paragraph.textContent.trim();
        const words = sentence.split(' ');

        // Cache le texte puis rend visible le paragraphe
        paragraph.textContent = '';
        paragraph.style.visibility = 'visible';

        for (const word of words) {
            const span = document.createElement('span');
            span.classList.add('word');
            span.textContent = word;
            paragraph.appendChild(span);

            await new Promise(res => setTimeout(res, delayBetweenWords));
            span.style.opacity = '1';
            span.style.transform = 'translateY(0)';
        }

        await new Promise(res => setTimeout(res, delayBetweenParagraphs));
    }

    const boxBtn = document.getElementById('box-btn');
    if (boxBtn) {
        boxBtn.hidden = false;
        boxBtn.style.display = 'flex';
        document.getElementById('btn-enter')?.focus()
    }


}

window.addEventListener('DOMContentLoaded', animateText);