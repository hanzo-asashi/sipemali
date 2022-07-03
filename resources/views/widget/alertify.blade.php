<script>
    window.addEventListener('notifikasi', event => {
        alertify.set('notifier', 'position', 'top-right');
        if (event.detail.success) {
            alertify.notify(event.detail.message, 'success', 3);
        } else {
            alertify.notify(event.detail.message, 'error', 3);
        }
    })

    window.addEventListener('alert', event => {
        if (event.detail.success) {
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
        $('#modal-detail-bayar').modal('show');
    })
    window.addEventListener('openAddModal', event => {
        $('#modal-detail-bayar').modal('show');
    })
    window.addEventListener('closeModal', event => {
        $('#modal-detail-bayar').modal('hide');
    })

    window.addEventListener('openModalTunggakan', event => {
        $('#modal-detail-tunggakan').modal('show');
    })
    window.addEventListener('openAddModalTunggakan', event => {
        $('#modal-detail-tunggakan').modal('show');
    })
    window.addEventListener('closeModalTunggakan', event => {
        $('#modal-detail-tunggakan').modal('hide');
    })

    window.addEventListener('openModalPju', event => {
        $('#modal-bayar-ppj').modal('show');
    })
    window.addEventListener('closeModalPju', event => {
        $('#modal-bayar-ppj').modal('hide');
    })

</script>
