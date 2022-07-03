<script>
    // window.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('livewire:load', function () {
        Livewire.on('triggerDelete', (id, tipe) => {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Anda tidak dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                   Livewire.emit('delete',id,tipe);
                    window.addEventListener('sendNotif', event => {
                        if(event.detail.type === 'success'){
                            Swal.fire({
                                title: event.detail.title,
                                text: event.detail.message,
                                icon: event.detail.type,
                                confirmButtonText: 'Oke',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            })
                        }else{
                            Swal.fire({
                                title: event.detail.title,
                                text: event.detail.message,
                                icon: event.detail.type,
                                confirmButtonText: 'Oke',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            })
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Batal menghapus!',
                        icon: 'success'
                    });
                }
            })
        });
    });

    window.addEventListener('livewire:load', function () {
        Livewire.on('triggerUpdateValid', (id, tipe) => {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Data akan diberikan status valid!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Validasi!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    Livewire.emit('updateValid',id,tipe);
                    window.addEventListener('sendNotif', event => {
                        if(event.detail.type === 'success'){
                            Swal.fire({
                                title: event.detail.title,
                                text: event.detail.message,
                                icon: event.detail.type,
                                confirmButtonText: 'Oke',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            })
                        }else{
                            Swal.fire({
                                title: event.detail.title,
                                text: event.detail.message,
                                icon: event.detail.type,
                                confirmButtonText: 'Oke',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                },
                                buttonsStyling: false
                            })
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Batal menghapus!',
                        icon: 'success'
                    });
                }
            })
        });
    });
</script>
