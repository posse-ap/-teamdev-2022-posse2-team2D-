

// function change_top(){
//     const top = document.getElementById('top');
//     const detail = document.getElementById('detail');
//     const info = document.getElementById('info');
//     top.style.display = 'block';
//     detail.style.display = 'none';
//     info.style.display = 'none';
// }

// function change_detail(){
//     const top = document.getElementById('top');
//     const detail = document.getElementById('detail');
//     const info = document.getElementById('info');
//     top.style.display = 'none';
//     detail.style.display = 'block';
//     info.style.display = 'none';
// }

// function change_info(){
//     const top = document.getElementById('top');
//     const detail = document.getElementById('detail');
//     const info = document.getElementById('info');
//     top.style.display = 'none';
//     detail.style.display = 'none';
//     info.style.display = 'block';
// }

// document.body.onclick = function (){ 
//     const page_change= document.getElementById('page_change');
//     if(page_change.style.display = 'block'){
//         page_change.style.display = 'none';
//     }else{
//         return;
//     }
    
// }

function page_changes(){
    const page_change= document.getElementById('page_change');
    page_change.classList.toggle('visual_set');
}


function inputChange(){
    var choice = document.getElementById("choice");
    console.log(choice.value);
    if(choice.value == 1){
        const top = document.getElementById('top');
        const detail = document.getElementById('detail');
        const info = document.getElementById('info');
        top.style.display = 'block';
        detail.style.display = 'none';
        info.style.display = 'none';
    }else if(choice.value == 2){
        const top = document.getElementById('top');
        const detail = document.getElementById('detail');
        const info = document.getElementById('info');
        top.style.display = 'none';
        detail.style.display = 'block';
        info.style.display = 'none';
    }
    else{
        const top = document.getElementById('top');
        const detail = document.getElementById('detail');
        const info = document.getElementById('info');
        top.style.display = 'none';
        detail.style.display = 'none';
        info.style.display = 'block';
    }
}