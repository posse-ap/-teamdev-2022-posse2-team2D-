function prev(){
    const num = document.getElementById('page_number');
    if(num.innerHTML>1){
        num.innerHTML = num.innerHTML - 1;
        console.log(num.innerHTML);
    }
    else{
        return;
    }
}

function next(){
    const num = document.getElementById('page_number');
    if(num.innerHTML>1){
        num.innerHTML = num.innerHTML + 1;
        console.log(num.innerHTML);
    }
    else{
        return;
    }
}