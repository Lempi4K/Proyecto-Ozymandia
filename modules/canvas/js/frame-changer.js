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
        canvasFrames[activeFrame].style.filter = "opacity(0)";
        canvasFrames[activeFrame].classList.toggle("frame-active");
        canvasFrames[activeFrame].animate(keyframesShow, animateOptions);
    };
}

function frame_changer(){
    canvasFrames = document.getElementsByClassName("canvas-frame");
    nFrames = canvasFrames.length;

    for(let i = 0; i < nFrames; i++){
        if(canvasFrames[i].classList.contains("frame-active")){
            activeFrame = i;
        }
    }

    const cnvFrmBackBtn = document.getElementsByClassName("cnvFrmBackBtn");
    for(let item of cnvFrmBackBtn){
        item.addEventListener("click", e => {
            returnFrame(e);
        });
    }
    const cnvFrmNextBtn = document.getElementsByClassName("cnvFrmNextBtn");
    for(let item of cnvFrmNextBtn){
        item.addEventListener("click", e => {
            advanceFrame(e);
            if(canvasFrames[activeFrame].id === "cnvFrmData"){
                renderArticle();
            }
        });
    }
}

