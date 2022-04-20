function prev(){
    const num = document.getElementById('page_number');
    if(num.innerHTML>1){
        num.innerHTML = num.innerHTML - 1;
    }
    else{
        return;
    }
}

function next(){
    const num = document.getElementById('page_number');
        num.va = num.innerHTML + 1;
}