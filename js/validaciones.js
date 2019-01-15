function validarnum(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    num = "1234567890.-";

    if(num.indexOf(tecla)==-1){
        return false;
    }
}