function openModal(taskModal, html, script) {
    taskModal.innerHTML = html;
    document.body.appendChild(taskModal);
    script.src = 'js/modal.js';
    document.body.appendChild(script);
}

function closeModal(taskModal, script) {
    taskModal.remove();
    script.remove();
}

// function updateSelectColor() {
//     dueTo.style.color = dueTo.value === '' ? 'grey' : 'black';
//     selectType.style.color = selectType.value === 'Select task type' ? 'grey' : 'black';
//     selectPriority.style.color = selectPriority.value === 'Select priority' ? 'grey' : 'black';
// }

// updateSelectColor();
// dueTo.addEventListener('change', updateSelectColor);
// selectType.addEventListener('change', updateSelectColor);
// selectPriority.addEventListener('change', updateSelectColor);

document.querySelectorAll('.taskCardWrapper').forEach(card => {
    card.addEventListener('click', () => {
        var taskId = card.dataset.taskId;
        fetch(`/editTask/${taskId}`)
            .then(response => response.text())
            .then(html => {
                const taskModal = document.createElement('div');
                const script = document.createElement('script');
                openModal(taskModal, html, script);
                const close = document.querySelector('.close');
                close.addEventListener('click', function () {
                    closeModal(taskModal, script);
            });
        });
    });
});

console.log(document.querySelector('#createBtn'));
document.querySelector('#createBtn').addEventListener('click', () => {
    fetch('/createTask')
        .then(response => response.text())
        .then(html => {
            const taskModal = document.createElement('div');
            const script = document.createElement('script');
            openModal(taskModal, html, script);
            const close = document.querySelector('.close');
            close.addEventListener('click', function () {
                closeModal(taskModal, script);
            });
        })
});


// sutvarkyti create ir issiaiskitni sasaja tarp /createTask ir js
