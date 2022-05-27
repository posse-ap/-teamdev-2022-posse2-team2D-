const add = document.querySelector(".add");
const select = document.querySelector("#tag");
const parent = document.querySelector(".form-control");
const error = document.querySelector(".error");
add.addEventListener("click", function () {
  if (parent.childElementCount > 4) {
    error.style.display = "block";
  } else {
    let clone = select.cloneNode(true);
    parent.appendChild(clone);
  }
});

const del = document.querySelector(".del");
del.addEventListener("click", function () {
  if (parent.childElementCount > 1) {
    parent.lastElementChild.remove();
  }
});

function change_agent() {
  const agent = document.getElementById("agent");
  const agency = document.getElementById("agency");
  agent.style.display = "block";
  agency.style.display = "none";
}

function change_agency() {
  const agent = document.getElementById("agent");
  const agency = document.getElementById("agency");
  agent.style.display = "none";
  agency.style.display = "block";
}

function change_agent() {
  const agent = document.getElementById("agent");
  const agency = document.getElementById("agency");
  agent.style.display = "block";
  agency.style.display = "none";
}

function change_agency() {
  const agent = document.getElementById("agent");
  const agency = document.getElementById("agency");
  agent.style.display = "none";
  agency.style.display = "block";
}

modal = document.getElementById('modal');

function modal_open(){
  modal.style.display = 'block';
}

function cancel(){
  modal.style.display = 'none';
}

// $(function(){
//   $("#send").on("click", function(event){
//     for (let i = 0; i < 10; i++) {
//       let id = $(`#check${i}`).val();
//     }
//     $.ajax({
//       type: "POST",
//       url: "index.php",
//       data: { "id" : id },
//       dataType : "json"
//     }).done(function(data){
//       $("#return").append('<p>'+data.id+' : '+data.school+' : '+data.skill+'</p>');
//     }).fail(function(XMLHttpRequest, status, e){
//       alert(e);
//     });
//   });
// });