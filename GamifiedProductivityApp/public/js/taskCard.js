document.addEventListener('DOMContentLoaded', () => {
   const taskCards = document.querySelectorAll('.taskCard');

   tasks.forEach((task, index) => {
       if (taskCards[index]) {
           const currentCard = taskCards[index];

           if (!task.on_time) {
               currentCard.style.borderLeftColor = '#454545';
               currentCard.querySelector('#completeBtn').textContent = 'Delete';
               // currentCard.querySelector('span').style.color = 'red';
           } else {
               currentCard.style.borderLeftColor = 'mediumpurple';
               currentCard.querySelector('#completeBtn').textContent = 'Complete';
           }
       }
   });
});
