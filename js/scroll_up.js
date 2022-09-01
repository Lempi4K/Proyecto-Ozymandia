function scroll(){
    try{
        let container = document.querySelector(".articles-container");
        if(container.scrollTop >= 500){
            container.scroll({
                    top: 0,
                    behavior: "smooth"
                }
            )
            container.scrollTop
        }
    }catch(error){
        console.log("Error line 12+1: Scroll_up")
    }
}

window.addEventListener("load", e => {
    let items = document.querySelectorAll(".navigation > ul label");
    for(let item of items){
        item.addEventListener("click", e => {
            scroll();
        });
    }
});