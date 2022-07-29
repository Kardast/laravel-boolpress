require('./bootstrap');

// js per la conferma di delete
// console.log('ciao');
// DA SISTEMARE, Dà PROBLEMI CON LA VISUALIZZAZIONE DELLE CARDS NEL FRONT
// const eleOverlay = document.querySelector('.overlay');
// if (eleOverlay) {
//     const deleteButtons = document.querySelectorAll('.js-delete');
//     const formPopup = document.querySelector('.popup');

//     deleteButtons.forEach(button => {
//         button.addEventListener('click', function () {
//             eleOverlay.classList.remove('d-none');

//             const id = this.closest('[data-id]').dataset.id
//             const pattern = formPopup.dataset.action;
//             const newAction = pattern.replace('*****', id);
//             formPopup.action = newAction;
//         })
//     });

//     document.querySelector('.js-no').addEventListener('click', function() {
//         eleOverlay.classList.add('d-none');
//     })
// }
