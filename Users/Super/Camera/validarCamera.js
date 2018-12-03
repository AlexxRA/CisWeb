function validarnum(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   num = "1234567890.-";

    if(num.indexOf(tecla)==-1){
        return false;
    }
}

function validarIP(){
    object=document.getElementById('ip_cam');
    label=document.getElementById('ipOk');
    //console.log(object);
    //valido = document.getElementById('emailOK');
    valueForm=object.value;

    var patron=/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/g;
    if(valueForm.search(patron)==0)
    {
        label.innerText="IP - valido";

        //object.setAttribute("placeholder","IP - valido");
        return;
    }
    label.innerText="IP - no valido";
    //object.setAttribute("placeholder","IP - no valido");
}



