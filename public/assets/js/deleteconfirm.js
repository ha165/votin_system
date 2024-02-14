i // Get all delete buttons with class 'delete-btn'
 const deleteButtons = document.querySelectorAll('.delete-btn');

 // Add event listener to each delete button
 deleteButtons.forEach(button => {
     button.addEventListener('click', function() {
         // Get voter id from data attribute
         const voterId = this.getAttribute('data-voter-id');

         // Show confirmation dialog
         const isConfirmed = confirm('Are you sure you want to delete this voter?');

         // If user confirms, submit the delete form
         if (isConfirmed) {
             document.getElementById('deleteForm' + voterId).submit();
         }
     });
 });