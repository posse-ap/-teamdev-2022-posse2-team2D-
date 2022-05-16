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
