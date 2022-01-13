let showAdd = document.querySelector('.crud-add');
let formAdd = document.querySelector('.form-crud-add');
let formTag = document.querySelector('.admin-display-detail>.more-info>form');

function showAddForm(){
    formAdd.style.display = formAdd.style.display == "flex" ? "none" : "flex";
}

function noSub(e) {
    e.preventDefault();
}

function updateTag() {
    let form = new FormData(formTag);

    fetch(formTag.attributes.action.value, {
        method: "POST",
        body: form,
    })
    .then(response => response.text())
    .then(response => document.querySelector('p').innerHTML = response)
    .catch(err => console.error(err));
}

if(showAdd != undefined) {
    showAdd.addEventListener('click',showAddForm);
}
if(formTag != undefined) {
    formTag.addEventListener("submit", noSub);
    formTag.lastElementChild.addEventListener('click', updateTag);
}