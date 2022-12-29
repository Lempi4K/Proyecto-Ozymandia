let profile_mainData = document.querySelector(".profile-mainData").offsetHeight;
let profile_background = document.querySelector(".profile-background").offsetHeight;
let profile_content = document.querySelector(".profile-content").offsetHeight;
let height = (profile_content) - (profile_mainData + profile_background);
document.querySelector(".profile-data-container").style.height = height + "px";

for(let item of document.getElementsByName("inpRdbtnProdiv")){
    item.addEventListener("change", e => {
        handleLocation("replazable-content_Profile", item.value, 0);
    });
}

document.getElementById("replazable-content_Profile").addEventListener("AJAXLoad", e => {
    console.log("prendido");
    let profile_mainData = document.querySelector(".profile-mainData").offsetHeight;
    let profile_background = document.querySelector(".profile-background").offsetHeight;
    let profile_content = document.querySelector(".profile-content").offsetHeight;
    let height = (profile_content) - (profile_mainData + profile_background);

    if(document.getElementById("inpRdbtnProdiv2").checked){
        let element = document.getElementById("articles-container") || document.querySelector(".display-error-main");
        element.style.height = height + "px";
    } else{
        document.querySelector(".profile-data-container").style.height = height + "px";
    }
});