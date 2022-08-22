let nav_memoryPersistance = {
    width: 50
};

function navOpener(e){
    const inpChkbxNav1 = e.target;
    const menu_hideNav = document.getElementById("menu-hideNav");
    const lblChkbxNav1 = document.getElementById("lblChkbxNav1");

    const keyframeMenuStart =[
        {height: "0px"},
        {height: nav_memoryPersistance.width + "px"}
    ];
    const keyframeMenuEnd =[
        {height: nav_memoryPersistance.width + "px"},
        {height: "0px"}
    ];
    const keyframeLabelStart =[
        {transform: "rotate(0deg)"},
        {transform: "rotate(90deg)"}
    ];
    const keyframeLabelEnd =[
        {transform: "rotate(90deg)"},
        {transform: "rotate(0deg)"}
    ];
    const animateOptions = {
        duration: 250,
        iterations: 1,
        easing: "ease-in-out",
        fill: "forwards"
    };

    if(inpChkbxNav1.checked){
        lblChkbxNav1.animate(keyframeLabelStart, animateOptions)
        .onfinish = () => {
            menu_hideNav.animate(keyframeMenuStart, animateOptions);
            menu_hideNav.style.display = "flex";
        };
    }else{
        lblChkbxNav1.animate(keyframeLabelEnd, animateOptions)
        .onfinish = () => {
            menu_hideNav.animate(keyframeMenuEnd, animateOptions)
            .onfinish = () => {
                menu_hideNav.style.display = "none";
            }
        };
    }
}

window.addEventListener("load", e => {
    document.getElementById("inpChkbxNav1").addEventListener("input", e => {
        navOpener(e);
    });
});

window.addEventListener("resize", e => {
    if(window.innerWidth < 315){
        document.getElementById("menu-hideNav").style.display = "none";
        nav_memoryPersistance.width = 100;
    }else{
        document.getElementById("menu-hideNav").style.display = "none";
        nav_memoryPersistance.width = 50;
    }

    if(window.innerWidth > 500){
        document.getElementById("inpChkbxNav1").checked = false;
        document.getElementById("menu-hideNav").style.display = "none";
    }
});