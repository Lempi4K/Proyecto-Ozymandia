/** 
 * Animacion de terminacion 1
 * @param string
*/
function ChargingAnimationEnd_1(idLoadAnimation = "charging-display-content"){
    let chargingDisplay = document.getElementById(idLoadAnimation);

    let keyframes = [
        {opacity: "1"},
        {opacity: "0"}
    ]
    let animateOptions= {
        duration: 300,
        iterations: 1,
        easing: "ease-in-out"
    };

    let f = chargingDisplay.animate(keyframes, animateOptions);
    f.onfinish = () => {
        chargingDisplay.style.display = "none";
    }
}

/** 
 * Animacion de inicio
 * @param string
*/
function ChargingAnimationStart(idLoadAnimation = "charging-display-content"){
    const chargingDisplay = document.getElementById(idLoadAnimation);
    chargingDisplay.style.display = "flex";

}

window.addEventListener("load", e => {
    const chargingDisplay = document.getElementById("charging-display-main");
    const img = document.querySelector("#charging-display-main > img");

    let keyframes = [
        {transform: "scale(1)"},
        {transform: "scale(3)"},
        {transform: "scale(0)"}
    ]
    let animateOptions = {
        duration: 300,
        iterations: 1,
        easing: "ease-in-out",
        fill: "forwards"
    };

    let f = img.animate(keyframes, animateOptions);
    f.onfinish = () => {
        let keyframes = [
            {opacity: "1"},
            {opacity: "0"}
        ]

        animateOptions.duration = 500;

        let f = chargingDisplay.animate(keyframes, animateOptions);

        f.onfinish = () => {
            chargingDisplay.style.display = "none";
        };
    }
});