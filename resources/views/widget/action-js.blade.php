<script>
    window.addEventListener('DOMContentLoaded', function () {
        @this.on('triggerDelete', (id, tipe) => {
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
                    let del = @this.call('delete', id, tipe);
                    if (del) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Data berhasil dihapus.',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'danger',
                            title: 'Failed!',
                            text: 'Data gagal dihapus.',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        })
                    }
                } else {
                    Swal.fire({
                        title: 'Batal menghapus!',
                        icon: 'success'
                    });
                }
            })
        });

        @this.on('inputNilaiPajak', (id) => {
            Swal.fire({
                title: 'Masukkan Nilai Pajak',
                input: 'text',
                // inputLabel:'Nilai Pajak',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.isConfirmed) {
                   @this.call('updateNilaiPajak', id, result.value);
                }
            })
        });


    });
</script>
