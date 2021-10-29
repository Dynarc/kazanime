let showAdd = document.querySelector('.crud-add');
let formAdd = document.querySelector('.form-crud-add');
let formModify = document.querySelector('.form-crud-modify');
let modifyButtons = document.querySelectorAll('.crud-list div>button:first-of-type');
let input = document.querySelector('.form-crud-modify>input');

function showAddForm(){
    formAdd.style.display = formAdd.style.display == "flex" ? "none" : "flex";
}

function showModifyForm(item, value){
    if((formModify.attributes.action.nodeValue == value && formModify.style.display == 'flex')||formModify.style.display != 'flex'){
        formModify.style.display = formModify.style.display == "flex" ? "none" : "flex";
    }
    formModify.setAttribute('action', value);
    let genre = item.parentElement.previousElementSibling.innerHTML;
    input.value = genre;
}


modifyButtons.forEach(button => {
    button.addEventListener('click', ()=>showModifyForm(button, button.value));
});

showAdd.addEventListener('click',showAddForm);