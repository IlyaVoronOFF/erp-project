<!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Удаление стадии</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Вы дейсвительно хотите удалить эту стадию?</p>
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
    $(function(){
        $('.delete').on('click', function() {
            var el_id = $(this).attr('rel');

            $('.delete-check').on('click', function(){
                //alert(el_id);
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'DELETE',
                    url:'/stages/' + el_id,
                    complete: function(){
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