// $(document).on("click", ".add", function() {
//     $(this).parent().clone(true).insertAfter($(this).parent());
// });
// $(document).on("click", ".del", function() {
//     var target = $(this).parent();
//     if (target.parent().children().length > 1) {
//         target.remove();
//     }
// });

const add =document.querySelector('.add');
const select = document.querySelector('#tag');
const parent = document.querySelector('.form-control')
add.addEventListener('click',function(){
    let clone = select.cloneNode(true);
    parent.appendChild(clone);
})

const del = document.querySelector('.del');
del.addEventListener('click',function(){
    parent.lastElementChild.remove();
})

function change_company(){
    const company = document.getElementById('company');
    const agency = document.getElementById('agency');
    company.style.display = 'block';
    agency.style.display = 'none';
}

function change_agency(){
    const company = document.getElementById('company');
    const agency = document.getElementById('agency');
    company.style.display = 'none';
    agency.style.display = 'block';
}