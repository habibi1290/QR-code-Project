import './bootstrap';
import '../css/app.css'


document.addEventListener("DOMContentLoaded", () => {


    const zahlInput = document.getElementById('zahl');
    const summeEl = document.getElementById('summe');
    const amountInput = document.getElementById('amount');

    if (zahlInput && summeEl && amountInput) {
        zahlInput.addEventListener('input', function () {
            let zahl = parseInt(this.value) || 0;
            let summe = zahl * 60;

            summeEl.innerText = summe.toFixed(2);
            amountInput.value = summe.toFixed(2);
        });
    } else {
        console.warn("Zahl/Summe/Amount Elemente nicht vorhanden");
    }


    const div = document.getElementById('box');
    if (!div) {
        console.warn("Element #box nicht gefunden");
        return;
    }

    let offsetX = 0, offsetY = 0;

    const move = (e) => {
        div.style.left = `${e.clientX - offsetX}px`;
        div.style.top  = `${e.clientY - offsetY}px`;
    };

    div.addEventListener('mousedown', (e) => {
        offsetX = e.clientX - div.offsetLeft;
        offsetY = e.clientY - div.offsetTop;
        document.addEventListener('mousemove', move);
    });

    document.addEventListener('mouseup', () => {
        document.removeEventListener('mousemove', move);
    });

    document.getElementById('dropdownMenu1').addEventListener('click', function () {
        this.classList.toggle('open');
    });

});

