const client_info = document.getElementById('client_info');
const client_edit = document.getElementById('client_edit');

function edit(){
    client_edit.style.display = 'block';
    client_info.style.display = 'none';
}

function save(){
    client_edit.style.display = 'none';
    client_info.style.display = 'block';
}