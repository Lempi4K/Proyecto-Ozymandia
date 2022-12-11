window.addEventListener("load", e => {
    let items = document.querySelectorAll("input[type='radio'].frame_change + label");
    for(let item of items){
        item.addEventListener("click", e => {
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

                let pathName = item.previousSibling.previousSibling.dataset.url;
                if(container.scrollTop == 0 && (location.pathname == ("/" + pathName))){
                    window.history.pushState({}, "xd", pathName);
                    handleLocation();
                }
            }catch(error){
                console.log("Error line 21: Scroll_up")
            }
        });
    }
});