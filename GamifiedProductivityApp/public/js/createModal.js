// Get the createModal
// createTask sripct is used to make default <select> option grey instead of black
var createBtn = document.getElementById('createBtn');
var createModal = document.getElementById('modalCreate');
var span = createModal.querySelector('.close');
var form = createModal.querySelector('form');
var task_name = createModal.querySelector('#task_name');
var selectPriority = createModal.querySelector('#priority');
var xp = createModal.querySelector('#xp');
var selectType = createModal.querySelector('#type');
var selectDate =  createModal.querySelector('#due_to');
function updateSelectColor() {
    selectDate.style.color = selectDate.value === '' ? 'grey' : 'black';
    selectType.style.color = selectType.value === '' ? 'grey' : 'black';
    selectPriority.style.color = selectPriority.value === '' ? 'grey' : 'black';
}

updateSelectColor();
selectDate.addEventListener('change', updateSelectColor);
selectType.addEventListener('change', updateSelectColor);
selectPriority.addEventListener('change', updateSelectColor);


// Function to reset form fields
function resetModalForm() {
    if (form)
        form.reset();
    task_name.value = "";
    selectPriority.value = "";
    xp.value = "";
    selectType.value = "";
    selectDate.value = "";
}

// Function to remove error messages
function clearModalErrors() {
    var errorList = createModal.querySelector("ul.bg-danger");
    if (errorList) errorList.remove();
}

// When the user clicks the button, open the createModal
createBtn.onclick = function() {
    createModal.style.display = "flex";
    // resetModalForm();
    clearModalErrors();
    updateSelectColor();
}


// When the user clicks on <span> (x), close the createModal and reset form and errors
span.onclick = function() {
    createModal.style.display = "none";
    // resetModalForm();
    clearModalErrors();
}

// When the user clicks outside the createModal, close and reset form and errors
window.onclick = function(event) {
    if (event.target == createModal) {
        createModal.style.display = "none";
        // resetModalForm();
        clearModalErrors();
    }
}

// When the user submits the form, reset fields and errors after submission
// if (form) {
//     form.onsubmit = function() {
//         // resetModalForm();
//         // clearModalErrors();
//     }
// }



