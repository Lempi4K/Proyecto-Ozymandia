async function AJAXrequestRecoveryDkm(){
    const url = "/modules/drk-mode/controller/drk-mode_controller.php";
    const params = {
        mode: 1
    };
    const options = {
        method : "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify(params)
    };
    
    try{
        let res = await fetch(url, options), json = await res.json();
        if (!res.ok){
            throw new Error("AJAX-Request-Failed")
        }

        if(json.errors === ""){
            return json.data.dkm;
        } else{
            console.log("Errores en en servidor:\n" +
            (new String(json.errors)).replace(";", '\n'));
            return 3;
        }        
    } catch (err){
        console.log(`JavaScript.login_ajax:AJAX-Error: ${err}`)
    }
}

async function AJAXrequestSetDkm(setValue){
    const url = "/modules/drk-mode/controller/drk-mode_controller.php";
    const params = {
        mode: 2,
        value: setValue
    };
    const options = {
        method : "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify(params)
    };
    
    try{
        let res = await fetch(url, options), json = await res.json();
        if (!res.ok){
            throw new Error("AJAX-Request-Failed")
        }

        if(json.errors === ""){
            return true;
        } else{
            console.log("Errores en en servidor:\n" +
            (new String(json.errors)).replace(";", '\n'));
            return false;
        }        
    } catch (err){
        console.log(`JavaScript.login_ajax:AJAX-Error: ${err}`)
    }
}

const styles = document.documentElement.style;

function dark(){
    styles.setProperty("--color_1", "black");
    styles.setProperty("--color_2", "rgb(25, 25, 25)");
    styles.setProperty("--color_3", "black");
    styles.setProperty("--color_4", "rgb(155, 155, 155)");
    styles.setProperty("--color_5", "rgb(27, 27, 27)");
    styles.setProperty("--color_6", "white");
    styles.setProperty("--user-color_I", "rgb(0, 118, 154)");
    styles.setProperty("--user-color_U", "rgb(0, 156, 0)");
    styles.setProperty("--user-color_A", " rgb(158, 0, 0)");
    styles.setProperty("--user-color_D", "rgb(161, 86, 0)");
    styles.setProperty("--user-color_M", "rgb(155, 152, 0)");
    styles.setProperty("--user-color_P", "rgb(148, 0, 64)");
    styles.setProperty("--user-color_J", "rgb(0, 7, 136)");
    styles.setProperty("--user-color_C", "rgb(33, 161, 144)");
    styles.setProperty("--font-color_1", "rgb(255, 255, 255)");
    styles.setProperty("--font-color_3", "rgb(192, 192, 192)");
    styles.setProperty("--font-color_4", "rgb(160, 160, 160)");
    styles.setProperty("--font-color_5", "rgb(93, 93, 93)");
    styles.setProperty("--hover-color_1", "rgb(40, 40, 40)");
    styles.setProperty("--select-color_1", "rgb(59, 59, 59)");
    styles.setProperty("--hover-color_2", "#bf5571");
    styles.setProperty("--select-color_2", "#901a3a");
    styles.setProperty("--hover-color_3", "rgb(10, 10, 10)");
    styles.setProperty("--select-color_3", "rgb(30, 30, 30)");
    styles.setProperty("--shComplementary-color_3", "rgb(40, 40, 40)");
    styles.setProperty("--shBackground-color_3", "black");
    styles.setProperty("--hover-color_4", "rgba(10, 10, 10, 0.7)");
    styles.setProperty("--select-color_4", "rgba(30, 30, 30, 0.7)");
    styles.setProperty("--shComplementary-color_4", "rgba(40, 40, 40, 0.7)");
    styles.setProperty("--shBackground-color_4", "rgba(0, 0, 0, 0.7)");
    styles.setProperty("--hover-color_5", "rgb(23, 23, 23)");
    styles.setProperty("--select-color_5", "rgb(38, 38, 38)");
    styles.setProperty("--form-color_1", "#a61c41");
    styles.setProperty("--form-color_2", "rgb(217, 217, 217)");
    styles.setProperty("--form-color_3", "black");
    styles.setProperty("--article-color_1", "white");
    styles.setProperty("--article-color_2", "rgb(40, 40, 40)");
    styles.setProperty("--article-color_3", "rgb(62, 62, 62)");
    styles.setProperty("--article1-color_1", "rgb(74, 74, 74)");
    styles.setProperty("--article1--text-color_1", "white");
    styles.setProperty("--article1--text-color_2", "red");
    styles.setProperty("--article1--text-color_3", "white");
}

function light(){
    styles.setProperty("--color_1", "white");
    styles.setProperty("--color_2", "#f6f6f6");
    styles.setProperty("--color_3", "white");
    styles.setProperty("--color_4", "rgb(100, 100, 100)");
    styles.setProperty("--color_5", "rgb(228, 228, 228)");
    styles.setProperty("--color_6", "rgb(217, 217, 217)");
    styles.setProperty("--user-color_I", "rgb(171, 235, 255)");
    styles.setProperty("--user-color_U", "rgb(76, 206, 76)");
    styles.setProperty("--user-color_A", " rgb(255, 162, 162)");
    styles.setProperty("--user-color_D", "rgb(255, 210, 158)");
    styles.setProperty("--user-color_M", "rgb(255, 253, 156)");
    styles.setProperty("--user-color_P", "rgb(255, 150, 195)");
    styles.setProperty("--user-color_J", "rgb(160, 164, 255)");
    styles.setProperty("--user-color_C", "rgb(81, 231, 211)");
    styles.setProperty("--font-color_1", "black");
    styles.setProperty("--font-color_3", "rgb(63, 63, 63)");
    styles.setProperty("--font-color_4", "rgb(95, 95, 95)");
    styles.setProperty("--font-color_5", "rgb(162, 162, 162)");
    styles.setProperty("--hover-color_1", "rgb(215, 215, 215)");
    styles.setProperty("--select-color_1", "rgb(196, 196, 196)");
    styles.setProperty("--hover-color_2", "#bf5571");
    styles.setProperty("--select-color_2", "#901a3a");
    styles.setProperty("--hover-color_3", "rgb(245, 245, 245)");
    styles.setProperty("--select-color_3", "rgb(235, 235, 235)");
    styles.setProperty("--shComplementary-color_3", "rgb(222, 222, 222)");
    styles.setProperty("--shBackground-color_3", "white");
    styles.setProperty("--hover-color_4", "rgba(245, 245, 245, 0.7)");
    styles.setProperty("--select-color_4", "rgba(235, 235, 235, 0.7)");
    styles.setProperty("--shComplementary-color_4", "rgba(222, 222, 222, 0.7)");
    styles.setProperty("--shBackground-color_4", "rgba(255, 255, 255, 0.7)");
    styles.setProperty("--hover-color_5", "rgb(232, 232, 232)");
    styles.setProperty("--select-color_5", "rgb(217, 217, 217)");
    styles.setProperty("--form-color_1", "#a61c41");
    styles.setProperty("--form-color_2", "rgb(217, 217, 217)");
    styles.setProperty("--form-color_3", "black");
    styles.setProperty("--article-color_1", "black");
    styles.setProperty("--article-color_2", "rgb(255, 255, 255)");
    styles.setProperty("--article-color_3", "rgb(215, 215, 215)");
    styles.setProperty("--article1-color_1", "rgb(181, 181, 181)");
    styles.setProperty("--article1--text-color_1", "black");
    styles.setProperty("--article1--text-color_2", "red");
    styles.setProperty("--article1--text-color_3", "black");
}

function colorHub(switcher, start=true){
    switch (switcher){
        case 1:{
            dark();
            break;
        }
        case 2:{
            light();
            break;
        }
        case 3:{
            if(!start){
                document.querySelector("#inpRdbtnDrkMode3 + label").innerHTML = "<i><i></i></i>Sistema (Refresca)";
            }
            break;
        }
    }
}

const actions = {
    "1": AJAXrequestSetDkm,
    "2": AJAXrequestSetDkm,
    "3": AJAXrequestSetDkm
}

async function colorSwitcher(item){
    if(!document.getElementById("inpRdbtnDrkMode3").checked){
        document.querySelector("#inpRdbtnDrkMode3 + label").innerHTML = "<i><i></i></i>Sistema";
    }
    const id = new String(item.id);
    const lastCharId = id.charAt(id.length-1);
    if(document.getElementById("UserButton").dataset.perm != "I"){
        await actions[lastCharId](parseInt(lastCharId))
    }
    colorHub(parseInt(lastCharId), false);
}

window.addEventListener("load", e => {
    const inpRadioDrkMode = document.getElementsByClassName("DrkMode");
    for(let item of inpRadioDrkMode){
        item.addEventListener("input", e => {
            colorSwitcher(item);
        });
    }
});

async function startSwitcher(){
    const dkm = await AJAXrequestRecoveryDkm();
    colorHub(dkm);
    document.getElementById("inpRdbtnDrkMode" + dkm).checked = true;
}

startSwitcher();