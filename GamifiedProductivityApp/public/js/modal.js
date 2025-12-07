var now;
function updateMinDateTime() {
    now = new Date();
    document.getElementById('due_to').min = now.toISOString().slice(0,16);
}

var taskModal = document.querySelector('#modal');
var close = document.querySelector('.close');
var taskName = document.querySelector('#task_name');
var selectPriority = document.querySelector('#priority');
var xp = document.querySelector('#xp');
var selectType = document.querySelector('#type');
var dueTo = document.querySelector('#due_to');
var updateButton = document.querySelector('.d-block');
function updateSelectColor() {
    dueTo.style.color = dueTo.value === '' ? 'grey' : 'black';
    selectType.style.color = selectType.value === 'Select task type' ? 'grey' : 'black';
    selectPriority.style.color = selectPriority.value === 'Select priority' ? 'grey' : 'black';
}
function checkInputs() {
    var taskNameValue = taskName.value;
    var xpValue = Number(xp.value);
    var min = Number(xp.min);
    var max = Number(xp.max);
    var dueToValue = new Date(dueTo.value);
    var selectPriorityValue = selectPriority.value;
    var selectTypeValue = selectType.value;
    if (
        taskNameValue.length > 50 ||
        taskNameValue.length <= 0 ||
        xpValue > max ||
        xpValue < min ||
        dueToValue < now ||
        dueToValue == "Invalid Date" ||
        selectPriorityValue == "Select priority" ||
        selectTypeValue == "Select task type"
    ) {
        updateButton.disabled = true;
        updateButton.style.backgroundColor = 'grey';
    } else {
        updateButton.disabled = false;
        updateButton.style.backgroundColor = '#0088E2';
    }
}
updateSelectColor();
selectType.addEventListener('change', updateSelectColor);
dueTo.addEventListener('change', updateSelectColor);
selectPriority.addEventListener('change', updateSelectColor);
updateMinDateTime();
checkInputs();
updateMinDateTimeIntervalId = setInterval(updateMinDateTime, 2000);
checkInputsIntervalId = setInterval(checkInputs, 1000);

close.addEventListener('click', function() {
    clearInterval(updateMinDateTimeIntervalId);
    clearInterval(checkInputsIntervalId);
})

taskModal.addEventListener('input', function() {
    checkInputs();
});
