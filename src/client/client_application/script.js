$(document).on("click", ".add", function () {
  $(this).parent().clone(true).insertAfter($(this).parent());
});
$(document).on("click", ".del", function () {
  var target = $(this).parent();
  if (target.parent().children().length > 1) {
    target.remove();
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
