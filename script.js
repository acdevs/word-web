function checkInput(i){
    var input=i.value;
    var btn=document.getElementById('btn');
    if(input == ""){
        btn.disabled=true;
    }else{
        btn.disabled=false;
    }
}