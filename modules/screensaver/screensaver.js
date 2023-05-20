let ssIndicator = false;
let ssTimer;
let segs = 120       

function ScreenSaver(){
    let SSanimateOptions = {
        duration: 200,
        iterations: 1,
        easing: "ease-in-out",
        fill: "forwards"
    };

    let keyframesShow = [
        {filter: "opacity(0)"},
        {filter: "opacity(1)"}
    ];

    let keyframesHide = [
        {filter: "opacity(1)"},
        {filter: "opacity(0)"}
    ];

    document.addEventListener("mousemove", e => {
        ScreenSaverL();
    });
    document.addEventListener("keydown", e => {
        ScreenSaverL();
    });
    document.addEventListener("touchmove", e => {
        ScreenSaverL();
    });
    document.addEventListener("scroll", e => {
        ScreenSaverL();
    });

    function showScreenSaver(){
        console.log("ahhha askdhaj h");
        document.querySelector(".screenSaver").style.display = "flex";
        document.querySelector(".screenSaver").animate(keyframesShow, SSanimateOptions);
        ssIndicator = true;
    }
    function hideScreenSaver(){
        document.querySelector(".screenSaver").animate(keyframesHide, SSanimateOptions)
        .onfinish = () => {
            document.querySelector(".screenSaver").style.display = "none";
        };
        ssIndicator = false;
    }

    function ScreenSaverL(){
        clearTimeout(ssTimer);

        if(ssIndicator){
            hideScreenSaver();
        }

        ssTimer = setTimeout(showScreenSaver, 1000 * segs);
    }

    ssTimer = setTimeout(showScreenSaver, 1000 * segs);
}

ScreenSaver();