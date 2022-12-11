memory_persistance_validator = {
    inpTxtUser : false,
    inpPassPassword : false
};

function onInputValidator(e, id){
    let input = e.target;
    let inputStr = new String(input.value);
    let hasChars = inputStr.includes('"') || inputStr.includes("'") ||  inputStr.includes(";") || inputStr.includes("=") || inputStr.includes("<") || inputStr.includes(">");
    if(inputStr.length != 0 && !hasChars){
        input.style.boxShadow = "none";
        input.style.borderColor = "#a3a3a3";
        memory_persistance_validator[id] = true;
    } else{
        input.style.boxShadow = "red 0px 0px 10px";
        input.style.borderColor = "red";
        memory_persistance_validator[id] = false;
    }

    if(memory_persistance_validator.inpTxtUser && memory_persistance_validator.inpPassPassword){
        document.getElementById("inpBtnLogin").disabled = false;
    } else{
        document.getElementById("inpBtnLogin").disabled = true;
    }
}

window.addEventListener("load", e => {
    document.getElementById("inpTxtUser").addEventListener("input", e => {
        onInputValidator(e, "inpTxtUser");
        e.target.value = (new String(e.target.value)).toLowerCase();
    });

    document.getElementById("inpPassPassword").addEventListener("input", e => {
        onInputValidator(e, "inpPassPassword");
    });

});