var OzyTool = class {
    static async AJAX(url, params, method = "POST") {
        const options = {
            method : method,
            headers: {
                'Content-Type': 'application/json'
            },
            body : JSON.stringify(params)
        };
        let text;
        try{
            let res = await fetch (url, options), json = await res.text();
            if (!res.ok){
                throw new Error("AJAX-Request-Failed");
            }
            let regex = /^(?<o>{((?<s>\"([^\0-\x1F\"\\]|\\[\"\\\/bfnrt]|\\u[0-9a-fA-F]{4})*\"):(?<v>\g<s>|(?<n>-?(0|[1-9]\d*)(.\d+)?([eE][+-]?\d+)?)|\g<o>|\g<a>|true|false|null))?\s*((?<c>,\s*)\g<s>(?<d>:\s*)\g<v>)*})|(?<a>\[\g<v>?(\g<c>\g<v>)*\])$/g;
            text = json;

            json = JSON.parse(json);
            /*
            if(regex.test(json)){
                success = true;
            } else{
                success = false;
            }
            */
            return {
                success: true,
                response: json
            };
        } catch (err){
            return {
                success: false,
                response: text
            };
        }
    }

    static stream(string, conf){
        let spotMessage = document.querySelector(".spotMessageText");
        let spot = document.querySelector(".spot");
        spotMessage.innerHTML = string;
        let animationIn = [
            {filter: "opacity(0)"},
            {filter: "opacity(1)"}
        ];
        let animationOut = [
            {filter: "opacity(1)"},
            {filter: "opacity(0)"}
        ];
        let animateOptions = {
            duration: 200,
            iterations: 1,
            easing: "ease-in-out",
            fill: "forwards"
        };

        let classLst = [
            "spotWarn",
            "spotError",
            "spotMessage"
        ];
        //console.log(classLst);
        spot.className = "spot " + classLst[conf - 1]
        spot.style.display = "block";
        let listener = spot.animate(animationIn, animateOptions);
        listener.onfinish = e => {
            setTimeout(() => {

                spot.animate(animationOut, animateOptions).onfinish = 
                    e => {
                        spot.style.display = "none";
                    };
            }, 3000);
        };

    }

    static CONST = {
        WARN: 1,
        ERROR: 2,
        MESSAGE: 3,
    }
    
    static async defaultAJAXListener(
                                    url, 
                                    params, 
                                    passFunction = (data) => {}, 
                                    refuseFunction = (data) => {})
                                    {
        let response = await OzyTool.AJAX(url, params);

        if(!response.success){
            OzyTool.stream("Error fatal en el servidor", OzyTool.CONST.ERROR);
            console.log(response.response);
            return -1;
        }

        if(response.response.error.indicator){
            OzyTool.stream("Error #" + response.response.error.number + " :: " + response.response.error.message, OzyTool.CONST.ERROR);
            return 0;
        }

        if(response.response.warn.indicator){
            OzyTool.stream("Advertencia " + response.response.warn.number + " :: " + response.response.warn.message, OzyTool.CONST.WARN);
        } 
        
        if(!response.response.success){
            refuseFunction(response.response.data);
            return 1;
        }

        if(response.response.message != ""){
            OzyTool.stream(response.response.message, OzyTool.CONST.MESSAGE);
        }
        passFunction(response.response.data);
        return 2;

    }

}