<!-- Modal -->
<div class="modal fade" id="exampleModalCenterEdit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Обновление записи</h5>
                <div id="displayDate" style="margin-left: 10px;"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form class="needs-validation" method="post" action="{{ route('pages.part-user.store') }}" validate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-lg-3 col-form-label" for="hour">Часы
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" id="hour" name="time"
                                placeholder="Кол-во отработанных часов.." required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-3 col-form-label" for="description">Примечание</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Комментарий к записи.."></textarea>
                        </div>
                    </div>
                    <input id="date" name="date" value="" hidden>
                    <input name="object_parts_id" value="{{ $part_id }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    {{-- <script>
        $(function() {
            $('[type="submit"]').on('click', function() {
                var time = $('#time').val();
                var description = $('#description').val();
                var date = moment(start).format('YYYY-MM-DD hh:mm:ss');
                console.log(time, description, date);
                // $.ajax({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     type: 'POST',
                //     url: '/part-user/' + time + description + date,
                //     complete: function() {
                //         $("#successMsg").delay(5000).slideUp(300);
                //         $("#errorMsg").delay(5000).slideUp(300);
                //         $('#exampleModalCenter').modal('hide');
                //         location.reload();
                //     }
                // })
                // $('.delete-check').on('click', function() {
                //     //alert(el_id);
                //     $.ajax({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         type: 'DELETE',
                //         url: '/object-parts/' + el_id,
                //         complete: function() {
                //             $("#successMsg").delay(5000).slideUp(300);
                //             $("#errorMsg").delay(5000).slideUp(300);
                //             $('#exampleModalCenter').modal('hide');
                //             location.reload();
                //         }
                //     })
                // })
            })
        });
    </script> --}}
@endpush
