@push('scripts')
    <script>
        $(".delete-data").click(function() {
            var url = $(this).attr('data-url');
            var journey = $(this).attr('data-journey');
            var url_redirect = $(this).attr('data-url-redirect');
            var id = $(this).attr('data-id');
            var token = '{!! csrf_token() !!}';
            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Saja'
            }).then((result) => {
                if (result.isConfirmed) {
                    //ajax delete
                    $.ajax({
                        url: url,
                        data: {
                            "id": id,
                            "journey_id": parseInt(journey),
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                )

                                if (url_redirect) {
                                    location.href = url_redirect;
                                } else {
                                    location.reload();
                                }
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    response.message,
                                    'error'
                                )
                            }
                        },
                        error: function(err) {
                            Swal.fire(
                                'Failed!',
                                "Pastikan koneksi stabil",
                                'error'
                            )
                            console.log(err);
                        }
                    });
                }
            })
        });
    </script>
@endpush
