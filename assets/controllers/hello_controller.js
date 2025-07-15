import { Controller } from '@hotwired/stimulus';


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static values = {
        sound: String
    }

    connect() {
        console.log('✅ Stimulus hello connecté');
        this.audio = new Audio(this.soundValue);
    }

    play() {
        console.log('chapi.mp3');

        this.audio.currentTime = 0;
        this.audio.play().catch(e => console.warn("Audio bloqué :", e));
    }
}

