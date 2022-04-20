let currentNum = 0;
    const num = document.getElementById('page_number');

function next(){
    currentNum++;
    num.innerHTML = currentNum;
}