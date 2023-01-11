AdminTools.Header = class {
    static animationDrop = [
            {height: "0px"},
            {height: "70px"}
        ];

    static animationPickUp = [
            {height: "70px"},
            {height  : "0px"}
        ];

    static animateOptions = {
        duration: 200,
        iterations: 1,
        easing: "ease-in-out",
        fill: "forwards"
    };

    static active = false;
}

function Header(){
    let section = (getParameterByName("section") == 0 ? 1 : getParameterByName("section"));
    console.log(section);
    document.getElementById("inpRdbtnMenu" + section).checked = true;
    window.history.pushState({}, "xd", "herramientas" + "?section=" + section);

    document.getElementById("inpChckbxATOMenu1").addEventListener("change", e => {
        let keyframe;
        if(e.target.checked){
            keyframe = AdminTools.Header.animationDrop;
        } else{
            keyframe = AdminTools.Header.animationPickUp;
        }

        document.querySelector(".atMenu").animate(keyframe, AdminTools.Header.animateOptions);
    });

    document.querySelector("html").addEventListener("click", e => {
        if(document.querySelector(".atMenu") != null && document.getElementById("inpChckbxATOMenu1").checked){
            keyframe = AdminTools.Header.animationPickUp;
            document.querySelector(".atMenu").animate(keyframe, AdminTools.Header.animateOptions);
            document.getElementById("inpChckbxATOMenu1").checked = false;
        }
    });

    document.querySelector(".atTopBar").addEventListener("click", e => {
        e.stopPropagation();
    });

    for(let item of document.getElementsByName("inpRdbtnMenu")){
        item.addEventListener("change", e => {
            if(item.checked){
                window.history.pushState({}, "xd", "herramientas" + "?section=" + parseInt(item.value));
                handleLocation("atReplazableContainer", parseInt(item.value), true);
            }
        });
    }
}