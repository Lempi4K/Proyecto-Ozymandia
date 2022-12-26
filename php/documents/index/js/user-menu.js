/** 
 * Oculta o muestra el menu de usuario
 * @param event
*/
function hide_show_menu(e){
    let inpChkbxUser = e.target;
    let user_hide_menu = document.getElementById("user-hide-menu");
    if(inpChkbxUser.checked){
        user_hide_menu.style.display = "block";
    } else{
        user_hide_menu.style.display = "none";
    }
}

/** 
 * Oculta el menu de usuario
 * @param event
*/
function blur_menu(e){
    document.getElementById("user-hide-menu").style.display = "none";
    document.getElementById("inpChkbxUser").checked = false;
}

/** 
 * Animación para mostrar el submenu
 * @param DOMObject
*/
function move_submenu(item){
    let submenu_Obtn = item;
    let submenu = document.getElementById(submenu_Obtn.id + "_Menu");
    let menu = document.getElementById("main-menu");
    let width = document.getElementById("user-hide-menu").offsetWidth;

    let keyframe_menu = [
        {left : "0px"},
        {left : "-" + width + "px"}
    ];
    let keyframe_submenu = [
        {left : width + "px"},
        {left : "0px"}
    ];
    let keyframe_parentBox = [
        {height : menu.offsetHeight + "px"},
        {height : submenu.offsetHeight + "px"}
    ];
    let animateOptions= {
        duration: 100,
        iterations: 1,
        easing: "ease-in-out",
        fill: "forwards"
    };
    

    menu.animate(keyframe_menu, animateOptions);
    submenu.animate(keyframe_submenu, animateOptions);
    document.getElementById("user-hide-menu").animate(keyframe_parentBox, animateOptions);
}

/** 
 * Oculta el submenu de usuario
 * @param event
*/
function hide_submenu(bck_target){
    let id_submenu = (new String(bck_target.id)).replace("_bck", "");
    let submenu = document.getElementById(id_submenu);
    let menu = document.getElementById("main-menu");
    let width = document.getElementById("user-hide-menu").offsetWidth;

    let keyframe_menu = [
        {left : "-" + width + "px"},
        {left : "0px"}
    ];
    let keyframe_submenu = [
        {left : "0px"},
        {left : width + "px"}
    ];
    let keyframe_parentBox = [
        {height : submenu.offsetHeight + "px"},
        {height : menu.offsetHeight + "px"}
    ];
    let animateOptions= {
        duration: 100,
        iterations: 1,
        easing: "ease-in-out",
        fill: "forwards"
    };

    menu.animate(keyframe_menu, animateOptions);
    submenu.animate(keyframe_submenu, animateOptions);
    document.getElementById("user-hide-menu").animate(keyframe_parentBox, animateOptions);
}



window.addEventListener("load", (e) => {
    document.getElementById("inpChkbxUser").addEventListener("change", e => {
        hide_show_menu(e);
    });

    document.querySelector("html").addEventListener("click", e => {
        blur_menu(e);
    });

    document.getElementById("user-FoBl").addEventListener("click", e => {
        e.stopPropagation();
    });

    let UHM_submenu_Obtns = document.getElementsByClassName("UHM-submenu-Obtn");
    for(let item of UHM_submenu_Obtns){
        item.addEventListener("click", e => {
            move_submenu(item);
        });
    }

    let UHM_submenu_Bbtns = document.getElementsByClassName("UHM-submenu-Bbtn");
    for(let item of UHM_submenu_Bbtns){
        item.addEventListener("click", e => {
            hide_submenu(item);
        });
    }
});