for(let inpRdbtn of document.getElementsByName("inpRdbtnTabContent")){
    inpRdbtn.addEventListener("change", e => {
        for(let label of document.querySelectorAll(".article_TabMenu label")){
            if(inpRdbtn.id == label.htmlFor){
                label.classList.add("article_TabActive");
            } else{
                if(label.classList.contains("article_TabActive")){
                    label.classList.remove("article_TabActive")
                }
            }
        }
    })
}