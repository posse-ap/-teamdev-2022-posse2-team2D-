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
    let currentNum = 0;
    const num = document.getElementById('page_number');
        num.innerHTML += 1;
}