var canvasFrames = document.getElementsByClassName("");
var nFrames = 0;
var activeFrame = 0;

var keyframesHide = [
    {filter: "opacity(1)"},
    {filter: "opacity(0)"}
]
var keyframesShow = [
    {filter: "opacity(0)"},
    {filter: "opacity(1)"}
]
var animateOptions = {
    duration: 200,
    iterations: 1,
    easing: "ease-in-out",
    fill: "forwards"
};

function advanceFrame(e){
    canvasFrames[activeFrame].animate(keyframesHide, animateOptions)
    .onfinish = () => {
        canvasFrames[activeFrame].classList.toggle("frame-active");
        activeFrame++;
        if(activeFrame >= nFrames){
            activeFrame--;
            canvasFrames[activeFrame].classList.toggle("frame-active");
            return
        }
        canvasFrames[activeFrame].style.filter = "opacity(0)";
        canvasFrames[activeFrame].classList.toggle("frame-active");
        canvasFrames[activeFrame].animate(keyframesShow, animateOptions);
    };
}
function returnFrame(e){
    canvasFrames[activeFrame].animate(keyframesHide, animateOptions)
    .onfinish = () => {
        canvasFrames[activeFrame].classList.toggle("frame-active");
        activeFrame--;
        if(activeFrame < 0){
            activeFrame++;
            canvasFrames[activeFrame].classList.toggle("frame-active");
            return;
        }
        canvasFrames[activeFrame].style.filter = "opacity(0)";
        canvasFrames[activeFrame].classList.toggle("frame-active");
        canvasFrames[activeFrame].animate(keyframesShow, animateOptions);
    };
}

function frame_changer(){
    activeFrame = 0;
    canvasFrames = document.getElementsByClassName("canvas-frame");
    nFrames = canvasFrames.length;

    for(let i = 0; i < nFrames; i++){
        if(canvasFrames[i].classList.contains("frame-active")){
            activeFrame = i;
        }
    }

    let cnvFrmBackBtn = document.getElementsByClassName("cnvFrmBackBtn");
    for(let item of cnvFrmBackBtn){
        item.addEventListener("click", e => {
            console.log("Retrocede")
            returnFrame(e);
        });
    }
    let cnvFrmNextBtn = document.getElementsByClassName("cnvFrmNextBtn");
    console.log("Numero de elementos: " + cnvFrmNextBtn.length)
    for(let item of cnvFrmNextBtn){
        item.addEventListener("click", e => {
            console.log("Avanza")
            advanceFrame(e);
            if(canvasFrames[activeFrame].id === "cnvFrmData"){
                renderArticle();
            }
        });
    }
}

