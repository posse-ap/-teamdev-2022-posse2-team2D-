$(document).on("click", ".add", function() {
    $(this).parent().clone(true).insertAfter($(this).parent());
});
$(document).on("click", ".del", function() {
    var target = $(this).parent();
    if (target.parent().children().length > 1) {
        target.remove();
    }
});

function change_company(){
    const company = document.getElementById('company');
    const agency = document.getElementById('agency');
    const info = document.getElementById('info');
    top.style.display = 'block';
    detail.style.display = 'none';
    info.style.display = 'none';
}

function change_agency(){
    const company = document.getElementById('company');
    const agency = document.getElementById('agency');
    const info = document.getElementById('info');
    top.style.display = 'none';
    detail.style.display = 'block';
    info.style.display = 'none';
}