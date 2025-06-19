// createTask sripct is used to make default <select> option grey instead of black
document.addEventListener('DOMContentLoaded', function() {
    const selectTask = document.getElementById('type');
    const selectDate = document.getElementById('due_to');
    const selectPriority = document.getElementById('priority');



    function updateSelectColor() {
        selectTask.style.color = selectTask.value === '' ? 'grey' : 'black';
        selectDate.style.color = selectDate.value === '' ? 'grey' : 'black';
        selectPriority.style.color = selectPriority.value === '' ? 'grey' : 'black';
    }

    updateSelectColor();
    selectTask.addEventListener('change', updateSelectColor);
    selectDate.addEventListener('change', updateSelectColor);
    selectPriority.addEventListener('change', updateSelectColor);

});
