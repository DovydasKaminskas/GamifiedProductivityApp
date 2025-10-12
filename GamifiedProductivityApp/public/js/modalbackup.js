// Get the createModal
var modal = document.getElementById("ModalCreate");
var btn = document.getElementById("createBtn");
var span = document.getElementsByClassName("close")[0];
var form = modal.querySelector("form");
// var create = document.getElementById('create');

// Function to reset form fields
function resetModalForm() {
    if (form) form.reset();
}

// Function to remove error messages
function clearModalErrors() {
    var errorList = modal.querySelector("ul.bg-danger");
    if (errorList) errorList.remove();
}

// When the user clicks the button, open the createModal
btn.onclick = function() {
    modal.style.display = "flex";
    resetModalForm();
    clearModalErrors();
}

// When the user clicks on <span> (x), close the createModal and reset form and errors
span.onclick = function() {
    modal.style.display = "none";
    resetModalForm();
    clearModalErrors();
}

// When the user clicks outside the createModal, close and reset form and errors
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        resetModalForm();
        clearModalErrors();
    }
}

// create.onclick = function() {
//     if (window.serverErrors && window.serverErrors.length > 0) {
//         createModal.classList.add('no-animation');
//         createModal.style.display = 'flex';
//     } else {
//         createModal.classList.remove('no-animation');
//         createModal.style.display = 'none';
//     }
// }

// When the user submits the form, reset fields and errors after submission
// if (form) {
//     form.onsubmit = function() {
//         resetModalForm();
//         clearModalErrors();
//     }
}


