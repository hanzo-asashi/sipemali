<script>
    window.addEventListener('notifikasi', event => {
        var options = {
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            showDuration: 500,
            positionClass: 'toast-top-right',
        }
        if (event.detail.type === 'success') {
            toastr['success'](event.detail.message, 'success', options);
        }else if (event.detail.type === 'info') {
            toastr['info'](event.detail.message, 'info',options);
        } else {
            toastr['error'](event.detail.message, 'error', options);
        }
    })

    window.addEventListener('alert', event => {
        if (event.detail.type) {
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'success',
                text: event.detail.message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar:true
            })
        } else {
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'error',
                text: event.detail.message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar:true
            })
        }
    });

    window.addEventListener('openModal', event => {
        $('#{{ $modalId }}').modal('show');
    })
    window.addEventListener('closeModal', event => {
        $('#{{ $modalId }}').modal('hide');
    })
</script>
