let currentNum = 0;
const num = document.getElementById('page_number');

    function prev(){
        if(num.innerHTML>1){
            currentNum--;
            num.innerHTML = currentNum;
        }
        else{
            return;
        }
    }
    

function next(){
    currentNum++;
    num.innerHTML = currentNum;
}