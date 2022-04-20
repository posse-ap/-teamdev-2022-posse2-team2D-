function prev(){
    const num = document.getElementById('page_number');
    if(num.innerHTML>1){
        num.innerHTML = num.innerHTML - 1;
    }
    else{
        return;
    }
}

let currentNum = 0;
    const num = document.getElementById('page_number');

function next(){
}