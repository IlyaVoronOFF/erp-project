<!-- Modal -->
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Удаление раздела</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="text-not-empty"></div>
                <p>Вы дейсвительно хотите удалить этот раздел?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary delete-check">Удалить</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        var partUser = @json($partUser);

        $(function() {
            $('.delete').on('click', function() {
                var el_id = $(this).attr('rel');

                $('.text-not-empty').text('');

                partUser.forEach(e => {
                    if (e.object_parts_id == el_id) {
                        return $('.text-not-empty').text('Раздел не пустой!');
                    }
                });
                $('.delete-check').on('click', function() {
                    //alert(el_id);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        url: '/object-parts/' + el_id,
                        complete: function() {
                            $("#successMsg").delay(5000).slideUp(300);
                            $("#errorMsg").delay(5000).slideUp(300);
                            $('#exampleModalCenter').modal('hide');
                            location.reload();
                        }
                    })
                })
            })
        });
    </script>
@endpush
