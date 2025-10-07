function confirmDelete(formId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won’t be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading before submitting
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait a moment',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit the form dynamically
            document.getElementById(formId).submit();
        }
    });
}