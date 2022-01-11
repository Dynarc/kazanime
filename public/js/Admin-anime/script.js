let showAdd = document.querySelector('.crud-add');
let formAdd = document.querySelector('.form-crud-add');

function showAddForm(){
    formAdd.style.display = formAdd.style.display == "flex" ? "none" : "flex";
}

showAdd.addEventListener('click',showAddForm);