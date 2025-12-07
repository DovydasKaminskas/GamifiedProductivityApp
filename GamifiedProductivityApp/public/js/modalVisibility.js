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

document.querySelectorAll('.taskCardWrapper').forEach(card => {
    const completeBtn = card.querySelector('#completeBtn');
    completeBtn.addEventListener('click', function(event) {
        event.stopPropagation();
    });
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
