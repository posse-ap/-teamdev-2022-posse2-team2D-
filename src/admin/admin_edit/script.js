// $(document).on("click", ".add", function() {
//     $(this).parent().clone(true).insertAfter($(this).parent());
// });
// $(document).on("click", ".del", function() {
//     var target = $(this).parent();
//     if (target.parent().children().length > 1) {
//         target.remove();
//     }
// });

const add = document.querySelector(".add");
const select = document.querySelector("#tag");
const parent = document.querySelector(".form-control");
add.addEventListener("click", function () {
  let clone = select.cloneNode(true);
  parent.appendChild(clone);
});

const del = document.querySelector(".del");
del.addEventListener("click", function () {
  parent.lastElementChild.remove();
});


const add2 = document.querySelector(".add2");
const select2 = document.querySelector("#tag2");
const parent2 = document.querySelector(".form-control2");
add2.addEventListener("click", function () {
  let clone2 = select2.cloneNode(true);
  parent2.appendChild(clone2);
});

const del2 = document.querySelector(".del2");
del2.addEventListener("click", function () {
  parent2.lastElementChild.remove();
});

function change_agent() {
  const agent = document.getElementById("agent");
  const agency = document.getElementById("agency");
  agent.style.display = "block";
  agency.style.display = "none";
}

function change_agency() {
  if(names.value == ''){
    console.log('申請はありません');
  }else{
    const agent = document.getElementById("agent");
    const agency = document.getElementById("agency");
    agent.style.display = "none";
    agency.style.display = "block";
  }
}


const alert = document.querySelector('.alert');
const names = document.querySelector('input[name="names2"]');

if(names.value == ''){
  alert.style.display = 'none';
}else{
  alert.style.display = 'inline';
}

modal = document.getElementById('modal');

function modal_open(){
  modal.style.display = 'block';
}

function cancel(){
  modal.style.display = 'none';
}