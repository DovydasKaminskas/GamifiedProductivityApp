// document.addEventListener('DOMContentLoaded', () => {
//     const taskCards = document.querySelectorAll('.taskCardWrapper');
//
//     taskCards.forEach(taskCard => {
//         if (tasks.xp)
//         taskCard.style.backgroundColor = '#f0f0f0';
//     });
// });
document.addEventListener('DOMContentLoaded', () => {
   const taskCards = document.querySelectorAll('.taskCard');

   tasks.forEach((task, index) => {
       if (taskCards[index]) {
           const currentCard = taskCards[index];

           if (!task.on_time) {
               currentCard.style.borderLeftColor = '#454545';
               // currentCard.querySelector('span').style.color = 'red';
           } else {
               currentCard.style.backgroundColor = '#C7E4F8';
           }
       }
   });
});
