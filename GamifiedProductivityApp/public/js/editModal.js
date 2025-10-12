// Get the editModal
// editTask sripct is used to make default <select> option grey instead of black
var editBtns = document.querySelectorAll(".editBtn");
var editModal = document.getElementById("modalEdit");
var span = editModal.querySelector('.close');
var form = editModal.querySelector('form');
var task_name = editModal.querySelector('#task_name'); // -----------
var selectPriority = editModal.querySelector('#priority');
var xp = editModal.querySelector('#xp');
var selectType = editModal.querySelector('#type');
var selectDate =  editModal.querySelector('#due_to');
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
    var errorList = editModal.querySelector("ul.bg-danger");
    if (errorList) errorList.remove();
}

// When the user clicks the button, open the editModal
editBtns.forEach(function(btn) {
    btn.onclick = function() {
        var taskId = btn.dataset.taskId;
        var taskName = btn.dataset.taskName;
        var priority = btn.dataset.priority;
        var xp = btn.dataset.xp;
        var type = btn.dataset.type;
        var dueTo = btn.dataset.dueTo;

        editModal.style.display = "flex";
        // resetModalForm();
        clearModalErrors();
        updateSelectColor();
    }
});
// editBtn.onclick = function() {
//     editModal.style.display = "flex";
//     // resetModalForm();
//     clearModalErrors();
//     updateSelectColor();
//
// }

// editBtn.onclick = function() {
//     editModal.style.display = "flex";
// }

// When the user clicks on <span> (x), close the editModal and reset form and errors
span.onclick = function() {
    editModal.style.display = "none";
    clearModalErrors();
}

// When the user clicks outside the editModal, close and reset form and errors
window.onclick = function(event) {
    if (event.target == editModal) {
        editModal.style.display = "none";
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


// Sutvarkyti modal, kad paspausdus ant create, nedingtu info edit modale. Ir normaliai veiktu open ir close f.

