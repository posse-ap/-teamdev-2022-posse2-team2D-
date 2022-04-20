function prev(){
    const num = document.getElementById('page_number');
    if(num.innerHTML>1){
        currentNum--;
        num.innerHTML = currentNum;
    }
    else{
        return;
    }
}

let currentNum = 0;
    const num = document.getElementById('page_number');

function next(){
    currentNum++;
    num.innerHTML = currentNum;
}