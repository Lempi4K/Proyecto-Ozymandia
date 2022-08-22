memory_persistance = {
    state : true,
    index : 0,
    first : true
};

window.addEventListener("load", e => {
    setInterval(() => {
        let imgWidth = document.querySelector(".gallery ul > li > img").offsetWidth;
        let container = document.querySelector(".gallery ul");

        let animateOptions = {
            duration: 500,
            iterations: 1,
            easing: "ease-in-out",
            fill: "forwards"
        };

        keyframe = [
            {marginLeft: "-" + (imgWidth*(memory_persistance.first? 1 : memory_persistance.index)) + "px"}, 
        ];

        if(memory_persistance.first){
            memory_persistance.first = false;
        }

        if(memory_persistance.state){
            memory_persistance.index += 1;
            if(memory_persistance.index == 5){
                memory_persistance.state = false;
            }
        } else{
            memory_persistance.index -= 1;
            if(memory_persistance.index == 0){
                memory_persistance.state = true;
            }
        }

        container.animate(keyframe, animateOptions)
    }, 10000);
    
    window.addEventListener("resize", e => {
        let imgWidth = document.querySelector(".gallery ul > li > img").offsetWidth;
        let container = document.querySelector(".gallery ul");

        let animateOptions = {
            duration: 1,
            iterations: 1,
            easing: "ease-in-out",
            fill: "forwards"
        };

        keyframe = [
            {marginLeft: "-" + (imgWidth*memory_persistance.index) + "px"}, 
        ];

        container.animate(keyframe, animateOptions);
    });
});