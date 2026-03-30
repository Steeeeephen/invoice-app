import './bootstrap';

console.log('Working')


// Flash message for notifications
document.querySelectorAll(".flash-message").forEach((flash) => {
    setTimeout(() => {
        flash.style.opacity = "0";
        setTimeout(() => flash.remove(), 500);
    }, 3000);
});

// Delete modal
const deleteModal = document.querySelector('#delete-modal');
const deleteButtons = document.querySelectorAll('.delete-btn');
const deleteForm = document.querySelector('#delete-form');
const closeDeleteModal = document.querySelector('#close-delete-modal');

if (deleteButtons){
    deleteButtons.forEach(button =>{
        button.addEventListener('click', (event)=> {
            deleteModal.classList.remove("hidden");
            // This tripped me up a bit so leaving this for future me...
            // In the button that opens the delete modal, there is a custom attribute called 'data-user-id'
            // the 'dataset' api is actually converting the kebab case data-user-id to camelcase.
            // The more you know!!!
            deleteForm.action = `users/${event.target.dataset.userId}`;
        })
    })
}

if(closeDeleteModal) {
    closeDeleteModal.addEventListener('click', ()=>{
        deleteModal.classList.add('hidden')
    })
}


//
document.querySelector('#invoice-status-select').addEventListener('change', function(){
    console.log('changed')
    window.location.href = '?status=' + this.value;
})
