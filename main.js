// COMPTE A REBOURS //

const countdown = document.getElementById("countdown");
const jours = document.getElementById("days");
const heures = document.getElementById("hours");
const minute = document.getElementById("minutes");
const secondes = document.getElementById("seconds");

// Set the date and time to count down to
let countDownDate = new Date("April 16, 2023 11:00:00").getTime();

// Update the countdown every second
let countdownInterval = setInterval(function() {

    // Get the current date and time
    let now = new Date().getTime();

    // Calculate the time remaining
    let timeRemaining = countDownDate - now;

    // Calculate days, hours, minutes, and seconds remaining
    var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    // Display the countdown in the element with ID "countdown"
    jours.innerHTML = days;
    if (jours.innerHTML < 10) {
        jours.innerHTML = "0"+ days;
    }
    heures.innerHTML = hours;
    if (heures.innerHTML < 10) {
        heures.innerHTML = "0"+ hours;
    }
    minute.innerHTML = minutes;
    if (minute.innerHTML < 10) {
        minute.innerHTML = "0"+ minutes;
    }
    secondes.innerHTML = seconds;
    if (secondes.innerHTML < 10) {
        secondes.innerHTML = "0"+ seconds;
    }

    // If the countdown is over, stop the interval and display a message
    if (timeRemaining < 0) {
        clearInterval(countdownInterval);
        jours.innerHTML = "0";
        heures.innerHTML = "0";
        minute.innerHTML = "0";
        secondes.innerHTML = "0";
    }
}, 1000);

// COMPORTEMENT DU FORM ET DES POPUPS //

const boutonInscription = document.getElementById("boutonInscription");
const form = document.querySelector('.formulaire');
const cguCheckbox = document.querySelector('input[name="CGU"]')
const boutonValider = document.querySelector('.valider');
const boutonRetour = document.getElementById("retour");
const overlay1 = document.querySelector(".overlay1");
const overlay2 = document.querySelector(".overlay2");
const close2 = document.querySelector(".close2");
const overlay3 = document.querySelector(".overlay3");
const close3 = document.querySelector(".close3");

boutonInscription.addEventListener("click", () => {
    overlay1.style.visibility = "visible";
    overlay1.style.opacity = "1";
})
            
boutonRetour.addEventListener("click", (event) => {
    overlay1.style.visibility = "hidden";
    overlay1.style.opacity = "0";
    
    overlay2.style.visibility = "visible";
    overlay2.style.opacity = "1";
    event.preventDefault();
});
           
close2.addEventListener("click", () => {
    overlay2.style.visibility = "hidden";
    overlay2.style.opacity = "0";
});

close3.addEventListener("click", () => {
    overlay3.style.visibility = "hidden";
    overlay3.style.opacity = "0";
    form.reset();
});